<?php

namespace App\Http\Controllers;

use App\Models\GradeSetting;
use Illuminate\Http\Request;

class GradeSettingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'min_score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'grade' => 'required',
            'status' => 'required',
        ]);

        GradeSetting::create($request->except('_token'));
        return back()->with('message', 'Grade created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'grade' => 'required',
            'status' => 'required',
        ]);

        $grade = GradeSetting::find($request->id);
        $grade->update($request->except('_token'));
        return back()->with('message', 'Grade updated successfully');
    }

    public function destroy($id)
    {
        GradeSetting::destroy($id);
        return back()->with('message', 'Grade deleted successfully'); 
    }
}
