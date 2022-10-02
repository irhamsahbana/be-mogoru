<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Person extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
