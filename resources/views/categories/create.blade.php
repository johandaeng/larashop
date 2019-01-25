@extends('layouts.global')

@section('title')
    Create Category
@endsection

@section('content')
<div class="col-md-8">     
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('categories.store')}}" method="post">
        @csrf
        <label for="name">Category Name</label>
        <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" name="name" id="name" value="{{old('name')}}" placeholder="Category Name">
        <div class="invalid-feedback">{{$errors->first('name')}}</div>
        <br>
        <label for="image">Category Image</label>
        <input class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" type="file" name="image" id="image" value="{{old('image')}}" placeholder="">
        <div class="invalid-feedback">{{$errors->first('image')}}</div>
        <br>
        <input class="btn btn-primary" type="submit" value="Save">
        <a class="btn btn-secondary" href="{{route('categories.index')}}">Cancel</a>
    </form>
</div>
@endsection