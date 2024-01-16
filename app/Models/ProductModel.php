<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "product";
    protected  $guarded = [];
    public function productDetail()
    {
        return $this->HasMany(ProductDetailModel::class,"product_id");
    }
    public function category()
    {
        return $this->belongsTo(CategoriesModel::class,"category_id");
    }
    public function imageP()
    {
        return $this->HasMany(ImageModel::class,"product_id");
    }

}
