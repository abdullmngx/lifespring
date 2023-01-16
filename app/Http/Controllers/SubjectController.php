<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Subject::create($request->only('name'));
        return back()->with('message', 'Subject created successfully');
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required']);
        Subject::find($request->id)->update($request->only('name'));
        return back()->with('message', 'Subject updated successfully');
    }

    public function destroy($id)
    {
        Subject::destroy($id);
        return back()->with('message', 'Subject deleted successfully');
    }
}
