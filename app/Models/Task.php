<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Task extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tasks';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', '_id');
    }
}
