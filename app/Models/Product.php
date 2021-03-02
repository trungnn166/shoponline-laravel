<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'brand_id',
        'description',
        'content',
        'tags',
        'tags_slug',
        'price',
        'status',
        'url',
        'parent_id',
        'image'
    ];

    protected $table = 'tbl_product';

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
