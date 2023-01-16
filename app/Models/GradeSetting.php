<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSetting extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['section_id', 'form_id','min_score', 'max_score', 'grade', 'status'];

    public function getSectionAttribute()
    {
        return Section::find($this->section_id)?->name;
    }

    public function getFormAttribute()
    {
        return Form::find($this->form_id)?->name;
    }
}
