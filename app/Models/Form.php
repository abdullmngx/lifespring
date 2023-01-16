<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['section_id', 'name', 'order'];

    public function getTotalBoysAttribute()
    {
        return Student::where('form_id', $this->id)->where('gender', 'male')->count();
    }

    public function getTotalGirlsAttribute()
    {
        return Student::where('form_id', $this->id)->where('gender', 'female')->count();
    }

    public function getTotalStudentsAttribute()
    {
        return Student::where('form_id', $this->id)->count();
    }

    public function getSectionNameAttribute()
    {
        return Section::find($this->section_id)?->name;
    }

    protected $append = ['total_boys', 'total_girls', 'total_students', 'section_name'];
}
