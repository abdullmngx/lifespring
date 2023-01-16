<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['session_id', 'term_id', 'form_id', 'arm_id', 'student_id', 'day', 'status'];
}
