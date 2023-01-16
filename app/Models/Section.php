<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'code', 'forms_name', 'total_forms', 'order'];

    public function getTotalBoysAttribute()
    {
        return Student::where('section_id', $this->id)->where('gender', 'male')->count();
    }

    public function getTotalGirlsAttribute()
    {
        return Student::where('section_id', $this->id)->where('gender', 'female')->count();
    }

    public function getTotalStudentsAttribute()
    {
        return Student::where('section_id', $this->id)->count();
    }

    protected $append = ['total_boys', 'total_girls', 'total_students'];
}
