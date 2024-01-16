@extends('layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin')}}">Home</a></li>
        <li class="breadcrumb-item active">Update Category</li>
      </ol>
    </nav>
  </div>
<div class="container-fuild">
    <form method="POST" action="{{ route('update_category')}}">  
        @csrf
        @method('put')
        <div class="modal-header">
            {{-- <h5 class="modal-title">Update Category</h5> --}}
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
          </div>
          <div class="modal-body">
            
                
            <div class="form-group">
                <label for="" class="form-lable mb-2">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập name ..." value="{{ $ca->name}}">
                <input type="hidden" name="id" value="{{ $ca->id}}">
            </div>
            
            <div class="form-group mt-2">
                <label for="" class="form-lable mb-2">Select Parent Folder</label>
                {{-- <input type="text" name="name" class="form-control" placeholder="Nhập name ..."> --}}
                <select class="form-select" name="parent_id">
                    <option value='0' selected>Choose...</option>
                        {!! $htmlSelect !!}
                  </select>
            </div>
          </div>
          <div class=" mt-5">
            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="{{ route('list_category')}}" class="btn btn-success">Quay Lai</a>
          </div>
    </form>
</div>
@endsection