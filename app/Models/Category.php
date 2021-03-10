<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_category';

    protected $fillable = ['id', 'name', 'description', 'status', 'url', 'parent_id'];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function childrens() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
