<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'url', 'price', 'description'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByName', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}
