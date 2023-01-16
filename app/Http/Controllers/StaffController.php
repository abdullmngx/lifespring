<?php

namespace App\Http\Controllers;

use App\Models\Arm;
use App\Models\ClassSubject;
use App\Models\Configuration;
use App\Models\Form;
use App\Models\GradeRemark;
use App\Models\GradeSetting;
use App\Models\Remark;
use App\Models\Section;
use App\Models\Session;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $staff = Staff::where('staff_id', $request->username)->orWhere('email', $request->username)->first();
        if (Hash::check($request->password, $staff->password))
        {
            Auth::guard('staff')->login($staff, $request->remember);
            return redirect()->intended('/staff/dashboard');
        }else
        {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function dashboard()
    {
        $data = [
            'count_students' => Student::count(),
            'count_staff' => Staff::count(),
            'count_subjects' => Subject::count(),
            'count_sections' => Section::count()
        ];

        $forms = Form::all();
        
        return view('admin.dashboard', ['data' => $data, 'forms'=> $forms]);
    }

    public function sections()
    {
        $sections = Section::all();
        return view('admin.sections', ['sections' => $sections]);
    }

    public function classes()
    {
        $forms = Form::all();
        return view('admin.classes', ['forms' => $forms]);
    }

    public function arms()
    {
        $arms = Arm::all();
        return view('admin.arms', ['arms' => $arms]);
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view('admin.subjects', ['subjects' => $subjects]);
    }

    public function grades()
    {
        $sections = Section::all();
        $grades = GradeSetting::all();
        return view('admin.grades', ['grades' => $grades, 'sections'=> $sections]);
    }

    public function remarks()
    {
        $sections = Section::all();
        $remarks = Remark::all();
        return view('admin.remarks', ['sections' => $sections, 'remarks' => $remarks]);
    }

    public function gradeRemarks()
    {
        $sections = Section::all();
        $grades = GradeSetting::all();
        $gradeRemarks = GradeRemark::all();
        return view('admin.grades_remark', ['grades' => $grades, 'grade_remarks' => $gradeRemarks, 'sections' => $sections]);
    }

    public function addStudents()
    {
        $forms = Form::all();
        $sections = Section::all();
        $arms = Arm::all();
        return view('admin.add_student', ['sections' => $sections, 'arms' => $arms, 'forms' => $forms]);
    }

    public function viewStudents()
    {
        $forms = Form::all();
        $sections = Section::all();
        $arms = Arm::all();
        $forms = Form::all();
        $students = [];
        $student = [];
        if (request()->has('form'))
        {
            $students = Student::where('form_id', request()->get('form'))->get();
        }
        if (request()->has('student'))
        {
            $student = Student::where('id', request()->get('student'))->first();
        }
        return view('admin.view_students', ['forms' => $forms, 'students' => $students, 'student' => $student, 'sections' => $sections, 'arms' => $arms, 'forms' => $forms]);
    }

    public function classSubjects(Request $request)
    {
        $forms = Form::all();
        $arms = [];
        $form = [];
        $arm = [];
        $subjects = [];
        $classSubjects = [];
        if ($request->has('form'))
        {
            $arms = Arm::all();
            $form = Form::find($request->get('form'));
        }

        if ($request->has('form') && $request->has('arm'))
        {
            $subjects = Subject::all();
            $form_id = $request->get('form');
            $arm_id = $request->get('arm');
            $classSubjects = ClassSubject::where('form_id', $form_id)->where('arm_id', $arm_id)->get();
            $arm = Arm::find($arm_id);
        }

        return view('admin.class_subjects', ['forms' => $forms, 'arms' => $arms, 'subjects' => $subjects, 'classSubjects' => $classSubjects, 'arm' => $arm, 'form' => $form]);
    }

    public function resultUpload(Request $request)
    {
        $forms = Form::all();
        $arms = [];
        $form = [];
        $arm = [];
        $students = [];
        $classSubjects = [];
        $subject = [];
        if ($request->has('form'))
        {
            $arms = Arm::all();
            $form = Form::find($request->get('form'));
        }

        if ($request->has('form') && $request->has('arm'))
        {
            $form_id = $request->get('form');
            $arm_id = $request->get('arm');
            $classSubjects = ClassSubject::where('form_id', $form_id)->where('arm_id', $arm_id)->get();
            $arm = Arm::find($arm_id);
        }

        if ($request->has('form') && $request->has('arm') && $request->has('subject'))
        {
            $current_session = Configuration::where('name', 'current_session')->first()?->value;
            $current_term = Configuration::where('name', 'current_term')->first()?->value;
            $subject_id = $request->get('subject');
            $students = Student::where('form_id', $form_id)->where('arm_id', $arm_id)->with(['result' => function ($q) use($current_session, $current_term, $subject_id) {
                $q->where('session_id', $current_session);
                $q->where('term_id', $current_term);
                $q->where('subject_id', $subject_id);
            }])->get();
            $subject = Subject::find($request->get('subject'));
        }

        return view('admin.result_upload', ['forms' => $forms, 'arms' => $arms, 'classSubjects' => $classSubjects, 'arm' => $arm, 'form' => $form, 'students' => $students, 'subject' => $subject]);
    }

    public function printResult()
    {
        $sessions = Session::all();
        $terms = Term::all();
        $sections = Section::all();
        $arms = Arm::all();
        return view('admin.print_result', ['sessions' => $sessions, 'terms' => $terms, 'sections' => $sections, 'arms' => $arms]);
    }

    public function configurations()
    {
        $configs = Configuration::all();
        return view('admin.configurations', ['configs' => $configs]);
    }

    public function addStaff()
    {
        return view('admin.add_staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'passport' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:staff',
            'phone_number' => 'required|numeric',
            'role' => 'required'
        ]);

        $staff = $request->except('_token');
        $passport = $request->file('passport')->store('uploads', 'public');
        
        $staff['passport'] = str_replace('public/', '', $passport);
        $staff['password'] = Hash::make($request->phone_number);

        Staff::unguard();
        $new_staff = Staff::create($staff);
        $staff_id = 'STAFF/'.date('y').'/'. sprintf('%04d', $new_staff->id);
        $new_staff->update(['staff_id' => $staff_id]);
        Staff::reguard();

        return back()->with('message', 'Staff created, login username is '. $staff_id. ' use phone number as password!');

    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff.login');
    }

    public function getFormsBySection($section_id)
    {
        $forms = Form::where('section_id', $section_id)->get();
        return response($forms, 200);
    }

    public function getChart()
    {
        $sections = Section::all();
        $codes = [];
        $boys = [];
        $girls = [];
        foreach ($sections as $section)
        {
            $codes[] = $section->code;
            $boys[] = $section->total_boys;
            $girls[] = $section->total_girls;
        }
        $chart = [
            'sections' => $codes,
            'boys' => $boys,
            'girls' => $girls
        ];
        return response($chart, 200);
    }
}
