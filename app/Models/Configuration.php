<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'field_type'];

    public function getDataAttribute()
    {
        if (!is_null($this->model))
        {
            return $this->model::all();
        }
        elseif(!is_null($this->seed))
        {
            $array = explode(',', $this->seed);
            foreach ($array as $index => &$value)
            {
                $array[$index] = ['id' => $value, 'name' => $value];
            }
            return $array;
        }
    }

    public function getTitleAttribute()
    {
        return str_replace('_', ' ', $this->name); 
    }
}
