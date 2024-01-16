@extends('layout.master')
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
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </nav>
</div>

<div class="div d-flex justify-content-end">
<button type="button" class="btn btn-primary mb-3 bt-3" data-bs-toggle="modal" data-bs-target="#basicModal">
    Add Category
  </button>
</div>
  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ route('add_category')}}">  
          @csrf
          <div class="modal-header">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label for="" class="form-lable mb-2">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Nhập name ...">
              </div>
              <div class="form-group mt-2">
                  <label for="" class="form-lable mb-2">Select Parent Folder</label>
                  {{-- <input type="text" name="name" class="form-control" placeholder="Nhập name ..."> --}}
                  <select class="form-select" name="parent_id">
                      <option value='0' selected>Choose...</option>
                          {{!! $htmlSelect !!}}
                    </select>
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





<div class="card">
    <div class="card-body">
      <h5 class="card-title">List category</h5>

      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $count=0;
            @endphp
            @foreach ($list as $item)
            @php
                 $count++;
            @endphp
               
          <tr>
            <th scope="row">{{ $count}}</th>
            <td>{{ $item->name}}</td>
            <td>
                <a href="{{ route('edit',[$item->id])}}" class="btn btn-success">Edit</a>
                <a href="" data-url="{{ route('delete_category',[$item->id])}}" class="btn btn-warning deleteCategory">Delete</a>
            </td>
             
            @endforeach
          </tr>

        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
</div>

@endsection