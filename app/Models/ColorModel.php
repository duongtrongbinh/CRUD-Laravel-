<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ColorModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "color";

    protected $fillable = [
        "id",
        "name",
        "code"
    ];
}
