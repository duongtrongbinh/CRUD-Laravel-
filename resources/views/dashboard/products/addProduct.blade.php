
@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/vendor/select2/index.min.css')}}">
<style>
  .icon{
    width: 30px;
    height: 60px;
  }

  .addBi::before{
    font-size: 20px !important;
    margin-top: 8px !important;
    margin-left: 5px !important;
    color: blue

  }
  .colorAdd{
    height: 37.6px;
  }
</style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active">Add Product</li>
      </ol>
    </nav>
  </div>
  {{-- action="{{ route('add_product')}}" --}}
<div class="container-fuild">
  <div class="row">
    <form method="POST" action="{{ route('add_product')}}" enctype="multipart/form-data">  
      @csrf
      {{-- @method('put') --}}
      <div class="modal-header">
          {{-- <h5 class="modal-title">Update Category</h5> --}}
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          
              
          <div class="form-group col">
              <label for="" class="form-lable mb-2">Name</label>
              <input type="text" name="name" class="form-control" placeholder="Nhập name ..." >
              {{-- <input type="hidden" name="id" value="{{ $ca->id}}"> --}}
          </div>
          <div class="form-group col mt-2">
            <label for="" class="form-lable mb-2">information content</label>
            <textarea class="form-control my-editor-tinymce4" name="desc_content" placeholder="Nhập information content ..."></textarea>
          </div>
          <div class="form-group mt-2 col">
            <label class="form-lable mb-2">Select choose cateygory</label>
            <select class="form-select" name="category_id">
              <option value="null" selected>Choose category</option>
              {{!! $htmlSelect !!}}
              </select>
          </div>
          <div class="row">
              <div class="form-group col-4 mt-3">
                <label for="" class="form-lable mb-2">Dimensions</label>
                <input type="text" name="dimensions" class="form-control" placeholder="Nhập Dimensions ..." >
            </div>
            <div class="form-group col-4 mt-3">
                <label for="" class="form-lable mb-2">Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="Nhập weight ..." >
            </div>
            <div class="form-group col-4 mt-3">
                <label for="" class="form-lable mb-2">Materials</label>
                <input type="text" name="material" class="form-control" placeholder="Nhập materials ..." >
            </div>
          </div>
          <div class="form-group mt-3">
            <label class="form-lable mb-2">Image</label>
            <input type="file" name="code[]" class="form-control" placeholder="Nhập image..." multiple>
          </div>
          
          {{-- them phan thuoc tinh san pham  --}}
          
          <div class="row mt-5">
            <div class="form-group mt-3 col-2 d-flex">
              <select class="form-control" name="size_id">
                <option value="null" selected>Choose size</option>
                  @foreach ($listsize as $item)
                    <option value='{{ $item->id}}'>{{ $item->name}}</option>
                  @endforeach
                </select>
                <i class="bi bi-clipboard-plus addBi" data-bs-toggle="modal" data-bs-target="#addsize"></i>
            </div>
            <div class="form-group mt-3 col-2 d-flex">
              <select class="form-control colorAdd" name="color_id">
                <option value="null" selected>Choose color</option>
                  @foreach ($listcolor as $item)
                    <option value='{{ $item->id}}'>{{ $item->name}}</option>
                  @endforeach
                </select>
                <i class="bi bi-clipboard-plus addBi" data-bs-toggle="modal" data-bs-target="#addcolor"></i>
            </div>
            <div class="form-group col-3 mt-3">
              <input type="text" name="quantity" class="form-control" placeholder="Nhập quantity ..." >
            </div>
            <div class="form-group col-3 mt-3">
                <input type="text" name="price" class="form-control" placeholder="Nhập price ..." >
            </div>
            <div class="form-group mt-3 col-2">
                <select class="form-control " name="status">
                    <option value="null" selected>Choose status</option>
                      @foreach ($productDetailStatus as $option => $value)
                        <option value='{{ $value}}'>{{ $option}}</option>
                      @endforeach
                </select>
            </div>
          </div>
          {{-- end them phan thuoc tinh san pham  --}}


        </div>
        <div class="mt-5 text-center">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="reset" class="btn btn-outline-warning">Reset</button>
        </div>
  </form>
  </div>
</div>

<div class="modal fade" id="addsize" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route("add_size")}}">  
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Add Size</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="" class="form-lable mb-2">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập name ...">
            </div>
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
    </form>
    </div>
  </div>
</div>
<div class="modal fade" id="addcolor" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('add_color')}}">  
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Add color</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="" class="form-lable mb-2">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập name ...">
            </div>
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
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


