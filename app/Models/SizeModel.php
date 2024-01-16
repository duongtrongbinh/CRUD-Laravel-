<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SizeModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "size";

    protected $fillable = [
        "id",
        "name",
        "code"
    ];
}
