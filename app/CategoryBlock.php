<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBlock extends Model
{
    protected $fillable = ['category_id', 'user_id'];
    protected $table = "category_user_block";
    public $timestamps = false;
}
