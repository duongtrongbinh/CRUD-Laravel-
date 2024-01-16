
@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendor/select2/index.min.css')}}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active">Update Product</li>
      </ol>
    </nav>
  </div>
  {{-- action="{{ route('add_product')}}" --}}
<div class="container-fuild">
  <div class="row">
    <form method="POST" action="{{ route('update_product')}}" enctype="multipart/form-data">  
      @csrf
      @method('put')
      <div class="form-group col">
        <label for="" class="form-lable mb-2">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Nhập name ..." value="{{ $product->name}}">
        <input type="hidden" name="id" value="{{ $product->id}}">
    </div>
    <div class="form-group col mt-2">
      <label for="" class="form-lable mb-2">information content</label>
      <textarea class="form-control my-editor-tinymce4" name="desc_content" placeholder="Nhập information content ...">{{ $product->desc_content}}</textarea>
    </div>
    <div class="form-group mt-2 col">
      <label class="form-lable mb-2">Select choose category</label>
      <select class="form-select" name="category_id">
        {{!! $htmlSelectCategory !!}}
        </select>
    </div>
    <div class="row">
        <div class="form-group col-4 mt-3">
          <label for="" class="form-lable mb-2">Dimensions</label>
          <input type="text" name="dimensions" class="form-control" placeholder="Nhập Dimensions ..." value="{{ $product->dimensions}}">
      </div>
      <div class="form-group col-4 mt-3">
          <label for="" class="form-lable mb-2">Weight</label>
          <input type="text" name="weight" class="form-control" placeholder="Nhập weight ..." value="{{ $product->weight}}">
      </div>
      <div class="form-group col-4 mt-3">
          <label for="" class="form-lable mb-2">Materials</label>
          <input type="text" name="material" class="form-control" placeholder="Nhập materials ..." value="{{ $product->material}}">
      </div>
    </div>
    <div class="form-group mt-3">
      <label class="form-lable mb-2">Image</label>
      <input type="file" name="code[]" class="form-control" placeholder="Nhập image..." multiple>
    </div>
    <div class="row d-flex mt-2 mb-2 text-center">
      @foreach ($product->imageP as $item)
      <div class="col-2" width="100%" height="100%">
        <img src="{{ $item->code}}" alt="{{ $item->name}}" width="100px" height="100px">
      </div>
      @endforeach
    </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Edit</button>
    </div>


    </form>
    </div>
  </div>
</div>


@endsection
@section('js')
<script src="{{ asset('admin/vendor/select2/index.min.js')}}"></script> 
<script src="{{ asset('admin/js/product/addProduct.js')}}"></script>
<script src="/path-to-your-tinymce/tinymce.min.js"></script>
@endsection