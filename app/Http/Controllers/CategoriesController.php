<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriesModel;
use App\Conponents\Recusives;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $category;
    function __construct(){
        $this->category = new CategoriesModel();
    }
    public function getCategory($parentid){
        $data = $this->category->all();
        $recusive = new Recusives($data);
        $htmlSelect = $recusive->categoryRecusive($parentid);
        return $htmlSelect;
    }
    public function index()
    {
        $list = $this->category->all();
       $htmlSelect = $this->getCategory($parentid = "");
        return view('dashboard.categories.category', compact('list','htmlSelect'));
    }

    public function store(Request $request)
    {

         $this->category->create([
            'name'=> $request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
         ]);
         return redirect()->route('list_category');

      
        }
        
    

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ca = $this->category->find($id);
        $htmlSelect = $this->getCategory($ca->parent_id);
        return view('dashboard.categories.updateCategory', compact('ca','htmlSelect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $this->category->find($request->id)->update([
            'id'=>$request->id,
            'name'=> $request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
         ]);
         return redirect()->route('list_category');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        // $this->category->deleteCategory($id);
        // dd($id);

        try {
        $this->category->find($id)->delete();
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
