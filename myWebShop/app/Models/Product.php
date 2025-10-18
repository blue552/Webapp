<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','stock','price','image'];
    public function categories()
    {
        return $this->belongstoMany(Category::class);
    }
    public function scopeByCategorySlug($query, $slug)
    {
    return $query->whereHas('categories', function ($q) use ($slug) {
        $q->where('slug', $slug);
    });
    }

}
