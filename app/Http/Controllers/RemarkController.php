<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'min_score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'teachers_remark' => 'required',
            'managers_remark' => 'required',
        ]);

        Remark::create($request->except('_token'));
        return back()->with('message', 'Remark created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'teachers_remark' => 'required',
            'managers_remark' => 'required',
        ]);

        $remark = Remark::find($request->id);
        $remark->update($request->except('_token'));
        return back()->with('message', 'Grade updated successfully');
    }

    public function destroy($id)
    {
        Remark::destroy($id);
        return back()->with('message', 'Grade deleted successfully'); 
    }
}
