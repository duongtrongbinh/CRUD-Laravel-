<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ImageModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "image";
    protected  $guarded = [];
}
