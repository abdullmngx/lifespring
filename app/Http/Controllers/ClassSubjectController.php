<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function store(Request $request)
    {
        $subjects = $request->subjects;
        $form_id = $request->form_id;
        $arm_id = $request->arm_id;

        foreach($subjects as $subject)
        {
            $subjectExists = ClassSubject::where('form_id', $form_id)->where('arm_id', $arm_id)->where('subject_id', $subject)->exists();
            if (!$subjectExists)
            {
                ClassSubject::create([
                    'form_id' => $form_id,
                    'arm_id' => $arm_id,
                    'subject_id' => $subject
                ]);
            }else
            {
                return back()->withErrors(['duplicate' => 'One of the selected subjects is already added']);
            }
        }

        return back()->with('message', 'Subjects Added');
    }

    public function destroy(Request $request)
    {
        $subjects = $request->subjects;
        foreach ($subjects as $subject) {
            ClassSubject::destroy($subject);
        }
        return back()->with('deleted', 'Subjects removed');
    }
}
