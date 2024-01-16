<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColorModel;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use App\Models\SizeModel;
use App\Models\StatusModel;
use App\Models\ImageModel;
use App\Models\CategoriesModel;
use App\Conponents\Recusives;
use App\Enums\ProductDetailStatus;
use Illuminate\Support\Str;
use App\Traits\StorageTraits;
use View;
use DB;
use Log;


class ProductController extends Controller
{
    protected $product;
    protected $productDetail;
    protected $size;
    protected $color;
    protected $image;
    protected $category;
    protected $storagetrait;
    protected $htmlSelect = "";

    function __construct(){
        $this->color = new ColorModel();
        $this->productDetail = new ProductDetailModel();
        $this->product = new ProductModel();
        $this->size = new SizeModel();
        $this->image = new ImageModel();
        $this->category = new CategoriesModel();
        $this->storagetrait = new StorageTraits();

        $productDetailStatus  = ProductDetailStatus::getArrayView();
        View::share('productDetailStatus', $productDetailStatus);
    }

    public function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusives($data);
        $htmlSelect = $recusive->categoryRecusive($parentid);
        return $htmlSelect;
    }

    public function index()
    {

        $count = 0;
        $listproduct = $this->product->all();
        $listsize = $this->size->all();
        $listcolor = $this->color->all();
        $quantity[]= '';
        return view('dashboard.products.product',compact('listproduct','count','listsize','listcolor','quantity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $htmlSelect = $this->getCategory($parentid = "");
        $listsize = $this->size->all();
        $listcolor = $this->color->all();
        return view('dashboard.products.addProduct',compact('listsize','listcolor','htmlSelect'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSize(Request $request)
    {  
        $this->size->create([
            'name'=> $request->name,
            'code'=>Str::slug($request->name)
         ]);
         return redirect()->route('from_add_product');
    }

    public function storeColor(Request $request)
    {  
        $this->color->create([
            'name'=> $request->name,
            'code'=>Str::slug($request->name)
         ]);
         return redirect()->route('from_add_product');
    }
    
    public function store(Request $request)
    {
        // dd($request->post());
        try {
            DB::beginTransaction();
            $newProduct = $request->only(['name','desc_content','category_id','dimensions','weight','material']);
            if(!empty($newProduct)){
                $newProduct['slug'] = Str::slug($request->name);
                $newProduct['code'] = 'SP'. Str::slug($request->name) . '1';
            };
            $product = $this->product->create($newProduct);
            if($request->hasFile('code')){
                foreach ($request->code as $item) {
                    $dataImageMui = $this->storagetrait->storageTraitUploadMuity($item, 'product');
                    $this->image->create([
                        'product_id'=>$product->id,
                        'code'=>$dataImageMui['file_path'],
                        'name'=>$dataImageMui['file_name']
                    ]);
                }
            }
            $newProductDetail = $request->only(['size_id','color_id','quantity','price','status']);
            if(!empty($newProductDetail)){
                $newProductDetail['product_id']=$product->id;
            }
            $this->productDetail->create($newProductDetail);
            DB::commit();
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }

    }

    public function storeProdutDetail(Request $request,string $id){
        try {
            DB::beginTransaction();
            $newProductDetail = $request->only(['size_id','color_id','quantity','price','status']);
            if(!empty($newProductDetail)){
                $newProductDetail['product_id']=$id;
            }
            // $productDetail = $this->productDetail->find($id);
            // foreach ($productDetail as $value) {
            //     if($value->size_id == $request->size_id){
            //         if($value->color_id == $request->color_id){

            //         }
            //     }
            // }
            $this->productDetail->create($newProductDetail);
            DB::commit();
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }

    public function edit(string $id)
    {
        $product =  $this->product->find($id);
        $htmlSelectCategory = $this->getCategory($product->category_id);
        return view('dashboard.products.updateProduct', compact('product','htmlSelectCategory'));
    }

    public function update(Request $request){
        // dd($request->id);
        try {
            DB::beginTransaction();
            $updateProduct = $request->only(['name','desc_content','category_id','dimensions','weight','material']);
            if(!empty($updateProduct)){
                $updateProduct['slug'] = Str::slug($request->name);
                $updateProduct['code'] = 'SP'. Str::slug($request->name) . '1';
            };
            $this->product->find($request->id)->update($updateProduct);
            if($request->hasFile('code')){
                $this->image->where('product_id',$request->id)->delete();
                foreach ($request->code as $item) {
                    $dataImageMui = $this->storagetrait->storageTraitUploadMuity($item, 'product');
                    $this->image->create([
                        'product_id'=>$request->id,
                        'code'=>$dataImageMui['file_path'],
                        'name'=>$dataImageMui['file_name']
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }
    public function updateProdutDetail(Request $request,string $id){
        try {
            DB::beginTransaction();
            $updateProductDetail = $request->only(['size_id','color_id','quantity','price','status']);
            if(!empty($updateProductDetail)){
                $updateProductDetail['product_id']=$id;
            }
            $this->productDetail->find($request->sid)->update($updateProductDetail);
            DB::commit();
            return redirect()->route('list_product');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage());
        }
    }
  
    
    public function destroy(string $id)
    {
        try {
            $this->productDetail->where('id',$id)->delete();
            return response()->json([
                'code' => 200,
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            Log::error("message: " . $exception->getMessage());
            return response()->json([
                'code' => 500,
                "message" => "false"
            ], 500);
        }

        

    }


    public function destroyProduct(string $id)
    {
        try {
            $this->product->where('id',$id)->delete();
            return response()->json([
                'code' => 200,
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            Log::error("message: " . $exception->getMessage());
            return response()->json([
                'code' => 500,
                "message" => "false"
            ], 500);
        }

        

    }
}
