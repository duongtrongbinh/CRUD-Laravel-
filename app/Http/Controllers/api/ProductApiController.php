<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use App\Models\ImageModel;
use App\Models\SizeModel;
use App\Models\ColorModel;

class ProductApiController extends Controller
{
    protected $product_detail;
    protected $product;
    protected $image;
    protected $size;
    protected $color;
    public function __construct(ProductDetailModel $productdetail,ProductModel $product,ImageModel $imag,SizeModel $sizee,ColorModel $colorr){
        $this->product_detail = $productdetail;
        $this->product = $product;
        $this->image = $imag;
        $this->size = $sizee;
        $this->color = $colorr;
    }

    public function index()
    {
        $listProduct = $this->product->all();
        $data =[];
        $listPro = [];
        foreach ($listProduct as $value) {
            $pro =  $this->product_detail->where('product_id',$value->id)->min('price');
            $promax =  $this->product_detail->where('product_id',$value->id)->max('price');
            $nameImageProduct = ($this->image->where('product_id',$value->id)->first())->name;
            $codeImageProduct = ($this->image->where('product_id',$value->id)->first())->code;
            $data =[
                'id'=>$value->id,
                'name'=>$value->name,
                'minPrice'=>$pro,
                'maxPrice'=>$promax,
                'nameImageProduct'=>$nameImageProduct,
                'codeImageProduct'=>$codeImageProduct
            ];
            $listPro[] = $data;
            
        }
        // dd($listPro);
        return view('guest.products.list',compact('listPro'));
        // dd($listPro);
        // return response()->json($listPro);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productO = $this->product->find($id);
        $minPrice =  $this->product_detail->where('product_id',$id)->min('price');
        $maxPrice =  $this->product_detail->where('product_id',$id)->max('price');
        $sizePro = ($this->product_detail->where('product_id',$id)->get('size_id'));
        $colorPro = ($this->product_detail->where('product_id',$id)->get('color_id'));

        $imageProduct = $this->image->where('product_id',$id)->get();
        return view('guest.products.product_detail',compact('productO','imageProduct','minPrice','maxPrice','sizePro','colorPro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
