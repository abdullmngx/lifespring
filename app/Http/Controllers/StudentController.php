<?php

namespace App\Http\Controllers;

use App\Models\AdmissionCount;
use App\Models\Arm;
use App\Models\Card;
use App\Models\Configuration;
use App\Models\Result;
use App\Models\Session;
use App\Models\Student;
use App\Models\Term;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric',
            'form_joined' => 'required',
            'section_id' => 'required',
            'form_id' => 'required',
            'arm_id' => 'required',
            'passport' => 'required'
        ]);

        $student = $request->except('_token');
        $passport = $request->file('passport')->store('public/uploads');

        $student['passport'] = str_replace('public/', '', $passport);
        $student['password'] = Hash::make('0000');

        $config = Configuration::where('name', 'current_session')->first();
        try
        {
            DB::beginTransaction();
            if (!$request->admission_number)
            {
                $count = AdmissionCount::where('session_id', $config->value)->first()?->count ?? 0;

                $admission_number = 'LS/'.date('y').'/'.sprintf('%04d', $count+1);
                $student['admission_number'] = $admission_number;
                AdmissionCount::updateOrCreate(['session_id' => $config->value],['count' => $count+1]);
            }

        
            
            Student::unguard();
            Student::create($student);
            Student::reguard();
            
            DB::commit();
        }
        catch (Exception $e)
        {
            throw $e;
            DB::rollBack();
        }
        return back()->with('message', 'Student Added successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'surname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric',
            'form_joined' => 'required',
            'section_id' => 'required',
            'form_id' => 'required',
            'arm_id' => 'required',
        ]);

        $data = $request->except('_token', 'student_id', 'passport', 'admission_number');
        $student = Student::find($request->student_id);
        if ($request->file('passport'))
        {
            Storage::disk('local')->delete('public/'.$student->passport);
            $passport = $request->file('passport')->store('public/uploads');
            $data['passport'] = str_replace('public/', '', $passport);
        }
        Student::unguard();
        $student->update($data);
        Student::reguard();
        return back()->with('message', 'Student info updated!');
    }

    public function showLogin()
    {
        return view('auth.student_login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);

        $student = Student::where('admission_number', $request->username)->orWhere('email', $request->username)->first();
        if ($student && Hash::check($request->password, $student->password))
        {
            Auth::guard('student')->login($student, $request->remember);
            return redirect()->intended(route('student.dashboard'));
        }
        else
        {
            return back()->withErrors(['username' => 'username or password incorrect']);
        }
    }

    public function dashboard()
    {
        $student = auth('student')->user();
        return view('student.dashboard', ['student' =>  $student]);
    }

    public function result()
    {
        $forms = Result::where('student_id', auth('student')->id())->distinct('form_id')->get(['form_id']);
        $arms = Result::where('student_id', auth('student')->id())->distinct('arm_id')->get(['arm_id']);;
        $sessions = Result::where('student_id', auth('student')->id())->distinct('session_id')->get(['session_id']);;
        $terms = Result::where('student_id', auth('student')->id())->distinct('term_id')->get(['term_id']);
        $config = Configuration::where('name', 'result_view')->first();
        return view('student.result', ['config' => $config, 'forms' => $forms, 'arms' => $arms, 'sessions' => $sessions, 'terms' => $terms]);
    }

    public function printResult(Request $request)
    {
        $request->validate([
            'form_id' => 'required',
            'arm_id' => 'required',
            'session_id' => 'required',
            'term_id' => 'required'
        ]);
        $student_id = auth('student')->id();
        $student = Student::where('id', $student_id)->with(['results' => function ($query) use ($request) {
            $query->where('session_id', $request->session_id);
            $query->where('term_id', $request->term_id);
            $query->where('form_id', $request->form_id);
            $query->where('arm_id', $request->arm_id);
        }])->first();

        //dd($student);
        $dompdf = Pdf::setOptions(['isRemoteEnabled' => true]);
        $meta = [
            'session' => Session::find($request->session_id)?->name,
            'term' => Term::find($request->term_id)?->name
        ];
        if ($request->has('pin'))
        {
            $request->validate([
                'pin' => 'required',
                'serial' => 'required'
            ]);
            $pin = $request->pin;
            $serial = $request->serial;

            if (!Card::where('pin', $pin)->where('serial', $serial)->where('status', '!=', 'used')->exists())
            {
                return back()->withErrors(['pin' => 'Invalid pin provided']);
            }
        }
        $pdf = $dompdf->loadView('printouts.result', ['student' => $student, 'meta' => $meta]);
        return $pdf->stream('result.pdf');
    }
}
