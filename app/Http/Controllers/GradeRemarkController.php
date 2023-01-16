<?php

namespace App\Http\Controllers;

use App\Models\GradeRemark;
use Illuminate\Http\Request;

class GradeRemarkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required',
            'remark' => 'required',
        ]);

        GradeRemark::create($request->except('_token'));
        return back()->with('message', 'Grade remark created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'grade_id' => 'required',
            'remark' => 'required',
        ]);

        $grade = GradeRemark::find($request->id);
        $grade->update($request->except('_token'));
        return back()->with('message', 'Grade remark updated successfully');
    }

    public function destroy($id)
    {
        GradeRemark::destroy($id);
        return back()->with('message', 'Grade remark deleted successfully'); 
    }
}
