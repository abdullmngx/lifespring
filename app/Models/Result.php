<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'result_id',
        'session_id',
        'term_id',
        'form_id',
        'arm_id',
        'subject_id',
        'student_id',
        'ca1_score',
        'ca2_score',
        'ca3_score',
        'ca4_score',
        'exam_score',
        'total_score',
        'grade_id',
    ];

    public function getGradeAttribute()
    {
        return GradeSetting::find($this->grade_id)?->grade;
    }

    public function getGradeRemarkAttribute()
    {
        return GradeRemark::where('grade_id', $this->grade_id)->first()?->remark;
    }
    
    public function getSubjectAttribute()
    {
        return Subject::find($this->subject_id)?->name;
    }

    public function getAverageAttribute()
    {
        $score_sum = Result::where('session_id', $this->session_id)->where('term_id', $this->term_id)->where('form_id', $this->form_id)->where('arm_id', $this->arm_id)->where('subject_id', $this->subject_id)->sum('total_score');
        $students_count = Result::where('session_id', $this->session_id)->where('term_id', $this->term_id)->where('form_id', $this->form_id)->where('arm_id', $this->arm_id)->where('subject_id', $this->subject_id)->count();
        return  $score_sum/$students_count;
    }

    public function getOverallScoreAttribute()
    {
        return Result::where('session_id', $this->session_id)->where('term_id', $this->term_id)->where('form_id', $this->form_id)->where('arm_id', $this->arm_id)->where('student_id', $this->student_id)->sum('total_score');
    }

    public function getTeachersRemarkAttribute()
    {
        return Remark::where('min_score', '<=', $this->getAttribute('overall_score'))->where('max_score', '>=', $this->getAttribute('overall_score'))->first()->teachers_remark;
    }
    public function getManagersRemarkAttribute()
    {
        return Remark::where('min_score', '<=', $this->getAttribute('overall_score'))->where('max_score', '>=', $this->getAttribute('overall_score'))->first()->managers_remark;
    }

    public function getFormAttribute()
    {
        return Form::find($this->form_id)?->name;
    }
    public function getArmAttribute()
    {
        return Arm::find($this->arm_id)?->name;
    }
    public function getSessionAttribute()
    {
        return Session::find($this->session_id)?->name;
    }
    public function getTermAttribute()
    {
        return Term::find($this->term_id)?->name;
    }
}
