<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Configuration;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $students = $request->student_ids;
        $form_id = $request->form_id;
        $arm_id = $request->arm_id;
        $current_session = Configuration::where('name', 'current_session')->first()->value;
        $current_term = Configuration::where('name', 'current_term')->first()->value;

        $count = count($students);

        for ($i=0; $i<$count; $i++)
        {
            $status = $request['status'.$students[$i]];
            Attendance::updateOrCreate(['session_id' => $current_session, 'term_id' => $current_term, 'form_id' => $form_id, 'arm_id' => $arm_id, 'student_id' => $students[$i]], ['session_id' => $current_session, 'term_id' => $current_term, 'form_id' => $form_id, 'arm_id' => $arm_id, 'student_id' => $students[$i],'status' => $status, 'day' => date('Y-m-d')]);
        }
        return back()->with('message', 'Attendance saved');
    }
}
