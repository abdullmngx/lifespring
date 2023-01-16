<?php

namespace App\Http\Controllers;

use App\Models\AdmissionCount;
use App\Models\Configuration;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
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
        $student['password'] = Hash::make(0000);

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
            Storage::delete($student->passport);
            $passport = $request->file('passport')->store('public/uploads');
            $data['passport'] = str_replace('public/', '', $passport);
        }
        Student::unguard();
        $student->update($data);
        Student::reguard();
        return back()->with('message', 'Student info updated!');
    }
}
