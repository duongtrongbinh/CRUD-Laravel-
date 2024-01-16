<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class CategoriesModel extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $table = "categories";

    protected $fillable = [
        "id",
        "name",
        "slug",
        "parent_id"
    ];

}
