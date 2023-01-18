<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    public function getFullNameAttribute()
    {
        return $this?->first_name. ' '. $this?->middle_name. ' '. $this?->surname;
    }

    public function getSectionAttribute()
    {
        return Section::find($this->section_id)?->name;
    }

    public function getFormAttribute()
    {
        return Form::find($this->form_id)?->name;
    }

    public function getArmAttribute()
    {
        return Arm::find($this->arm_id)?->name;
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function getClassTotalAttribute()
    {
        return Student::where('form_id', $this->form_id)->where('arm_id', $this->arm_id)->count();
    }

    public function getAttendanceAttribute()
    {
        return Attendance::where('day', date('Y-m-d'))->where('student_id', $this->id)->first()?->status;
    }

    public function getPresentCountAttribute()
    {
        $current_session = Configuration::where('name', 'current_session')->first()->value;
        $current_term = Configuration::where('name', 'current_term')->first()->value;
        return Attendance::match(['session_id' => $current_session, 'term_id' => $current_term,'status' => 'present'])->where('student_id', $this->id)->count();
    }

    public function getAbsentCountAttribute()
    {
        $current_session = Configuration::where('name', 'current_session')->first()->value;
        $current_term = Configuration::where('name', 'current_term')->first()->value;
        return Attendance::match(['session_id' => $current_session, 'term_id' => $current_term,'status' => 'absent'])->where('student_id', $this->id)->count();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
