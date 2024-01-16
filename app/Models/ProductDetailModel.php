<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ProductDetailModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'product_detail';
    protected  $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class,"product_id");
    }
    public function size()
    {
        return $this->belongsTo(SizeModel::class,"size_id");
    }
    public function color()
    {
        return $this->belongsTo(ColorModel::class,"color_id");
    }
   



    
}
