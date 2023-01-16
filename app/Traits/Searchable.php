<?php
namespace App\Traits;
trait Searchable
{

    /**
     * scope to search a model for records based on an
     * array of column-value pairs
     */
    public function scopeSearch($query, $columns)
    {
        foreach ($columns as $column => $value) {
            if (!empty($value))
            {
                $query->where(function ($q) use ($column, $value) {
                    $q->where($column, 'like', $value)
                        ->orWhere($column, 'like', '%');
                });
            }else {
                continue;
            }
        }
        return $query;
    }

    /**
     * scope to match a record in a model based on an
     * array of column-value pairs
     */
    public function scopeMatch($query, $columns)
    {
        foreach ($columns as $column => $value) {            
            if(is_null($value)){
                $columnName =  ucwords(str_replace('_',' ', explode('_id',$column)[0]));
                throw new \Exception("Please fill in your $columnName detail",404);        
            }
            $query->where(function ($q) use ($column, $value) {
                $q->where($column, 'like', $value)
                    ->orWhereNull($column)->orWhere($column,'');
                
            });
        }
        return $query;
    }
}
?>