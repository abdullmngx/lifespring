<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections',
            'code' => 'required',
            'forms_name' => 'required',
            'total_forms' => 'required',
            'order' => 'required',
        ]);

        $section = Section::create($request->only('name', 'code', 'forms_name', 'total_forms', 'order'));
        for ($x=1; $x <= $request->total_forms; $x++) { 
            $form = Form::where('section_id', $section->id)->where('name', $request->forms_name. ' '.$x)->exists();
            if (!$form)
            {
                Form::create([
                    'section_id' => $section->id,
                    'name' => $request->forms_name . ' ' . $x,
                    'order' => $x
                ]);
            }
        }
        return back()->with('message', 'Section created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'forms_name' => 'required',
            'total_forms' => 'required',
            'order' => 'required',
        ]);

        $section = Section::find($request->id);
        $section->update($request->only('name', 'code', 'forms_name', 'total_forms', 'order'));
        $forms = Form::where('section_id', $section->id)->get();
        foreach ($forms as $form) {
            $number = explode(' ', $form->name)[1];
            $new_name = $request->forms_name . ' ' . $number;
            $form->update([
                'name' => $new_name,
            ]);
        }
        return back()->with('message', 'Section updated successfully');
    }

    public function destroy($id)
    {
        Section::destroy($id);
        Form::where('section_id', $id)->delete();
        return back()->with('message', 'Section deleted successfully'); 
    }
}
