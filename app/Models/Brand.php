<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_brand';

    protected $fillable = [
        'name',
        'description',
        'status',
        'url'
    ];

}
