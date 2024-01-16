@extends('layout.master')
@section('css')
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
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/js/product/listProduct.js') }}"></script>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div>

<div class="div d-flex justify-content-end">
<a href="{{ route('from_add_product')}}" class="btn btn-primary mb-3 bt-3" >
    Add Product
  </a>
</div>


<div class="card">
    <div class="card-body">
      <h5 class="card-title">List product</h5>

      <!-- Table with stripped rows -->
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Sum Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($listproduct as $value)
            @php
               $count++;
            @endphp
          {{-- @foreach ($quantity as $sumquantity)
          @endforeach --}}

          <tr>
            <td scope="row">{{ $count}}</td>
            <td>{{ $value->code}}</td>
            <td>{{ $value->name}}</td>
            <td>{{ $value->category->name}}</td>
            <td>{{ $value->productDetail->sum('quantity')}}</td>
            <td>
              <button class="btn btn-primary" type="button"  data-bs-toggle="collapse" data-bs-target="#{{"addAtr".$value->id}}" aria-expanded="false" aria-controls="collapseExample">
                  Detail
              </button>
              <a href="{{ route('edit_product',[$value->id])}}" class="btn btn-success bt-3" >
                Edit
              </a>
              <a href="" data-url="{{ route('delete_product',[$value->id])}}" class="btn btn-warning deleteProduct">Delete</a>
            </td>

          </tr>

          <tr  class="collapse" id="{{"addAtr".$value->id}}" colspan="8">
            <td></td>
            <td colspan="7" class="bg-secondary">
              <table class="table text-center">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($value->productDetail as $item)
                  <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td>{{$item->size->name}}</td>
                    <td>{{$item->color->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format($item->price)}}  VND</td>
                    <td>
                      @foreach ($productDetailStatus as $option => $keyss)
                        @if($keyss == $item->status)
                          {{ $option}}
                        @endif
                      @endforeach
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary bt-3" data-bs-toggle="modal" data-bs-target="#{{'proDetail'.$item->id}}">
                        Add
                      </button>
                      <button type="button" class="btn btn-success bt-3" data-bs-toggle="modal" data-bs-target="#{{'editProDetail'.$item->id}}">
                        Edit
                      </button>
                      <a href="" class="btn btn-warning bt-3 deleteProductDetail" data-url="{{ route('delete_product_detail',[$item->id])}}">Delete</a> 
                    </td>
                  </tr>
                  <div class="modal fade" id="{{'proDetail'.$item->id}}" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <form method="POST" action="{{ route('add_product-detail',[$item->product_id])}}">  
                          @csrf
                          <div class="modal-header">
                              <h5 class="modal-title">Add Product Detail {{ $item->product_id}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row mt-5">
                                <div class="form-group mt-3 col-2">
                                  <select class="form-control" name="size_id">
                                    <option value="null" selected>Choose size</option>
                                      @foreach ($listsize as $item)
                                        <option value='{{ $item->id}}'>{{ $item->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3 col-2">
                                  <select class="form-control colorAdd" name="color_id">
                                    <option value="null" selected>Choose color</option>
                                      @foreach ($listcolor as $item)
                                        <option value='{{ $item->id}}'>{{ $item->name}}</option>
                                      @endforeach
                                    </select>
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
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                      </form>
                      </div>
                    </div>
                  </div> 
                  @endforeach
                </tbody>
              </table>
            </td>  
          </tr> 
         
          @endforeach

        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>






  @foreach ($listproduct as $value)

  @foreach ($value->productDetail as $keyVslue)

  <div class="modal fade" id="{{'editProDetail'.$keyVslue->id}}" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form method="POST" action="{{ route('edit_product-detail',[$value->id])}}">  
          @csrf
          @method('PUT')
          <div class="modal-header">
              <h5 class="modal-title">Edit Product Detail {{ $value->id}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mt-5">
                <div class="form-group mt-3 col-2">
                  <select class="form-control" name="size_id">
                    <option value="null" selected>Choose size</option>
                      @foreach ($listsize as $item)
                        <option  @php echo $keyVslue->size_id == $item->id ? "selected" : ''; @endphp value='{{ $item->id}}'>{{ $item->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group mt-3 col-2">
                  <select class="form-control colorAdd" name="color_id">
                    <option value="null" selected>Choose color</option>
                      @foreach ($listcolor as $item)
                        <option @php echo $keyVslue->color_id == $item->id ? "selected" : ''; @endphp value='{{ $item->id}}'>{{ $item->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group col-3 mt-3">
                  <input type="text" name="quantity" class="form-control" placeholder="Nhập quantity ..."  value="{{$keyVslue->quantity}}">
                  <input type="hidden" value="{{$keyVslue->id}}" name="sid">
                </div>
                <div class="form-group col-3 mt-3">
                    <input type="text" name="price" class="form-control" placeholder="Nhập price ..." value="{{$keyVslue->price}}">
                </div>
                <div class="form-group mt-3 col-2">
                    <select class="form-control " name="status">
                        <option value="null" selected>Choose status</option>
                          @foreach ($productDetailStatus as $option => $item)
                            <option @php echo $item == $value->status ? "selected" : ''; @endphp value='{{ $item}}'>{{ $option}}</option>
                          @endforeach

                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
      </form>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach


@endsection

