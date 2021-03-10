<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_banner';

    protected $fillable = [
        'id', 'name', 'image', 'status', 'description', 'url'
    ];
}
