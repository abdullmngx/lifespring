<?php

namespace App\Http\Controllers;

use App\Models\Arm;
use Illuminate\Http\Request;

class ArmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Arm::create($request->only('name'));
        return back()->with('message', 'Arm created successfully');
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required']);
        Arm::find($request->id)->update($request->only('name'));
        return back()->with('message', 'Arm updated successfully');
    }

    public function destroy($id)
    {
        Arm::destroy($id);
        return back()->with('message', 'Arm deleted successfully');
    }
}
