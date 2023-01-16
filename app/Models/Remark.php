<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'section_id',
        'form_id',
        'min_score',
        'max_score',
        'teachers_remark',
        'managers_remark',
    ];
}
