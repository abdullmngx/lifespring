<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['form_id', 'arm_id', 'subject_id'];

    public function getSubjectAttribute()
    {
        return Subject::find($this->subject_id)?->name;
    }

    public function getArmAttribute()
    {
        return Arm::find($this->arm_id)?->name;
    }
}
