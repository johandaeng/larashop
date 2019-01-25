@extends('layouts.global')

@section('title')
    Edit Category
@endsection

@section('content')
    <div class="col-md-8">
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('categories.update', ['id' => $category->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <label for="">Category Name</label>
            <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" name="name" value="{{old('name') ? old('name') : $category->name}}">
            <div class="invalid-feedback">{{$errors->first('name')}}</div>
            <br><br>
            <label for="">Category Slug</label>
            <input class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" type="text" name="slug" value="{{old('slug') ? old('slug') : $category->slug}}">
            <div class="invalid-feedback">{{$errors->first('slug')}}</div>
            <br><br>
            <label for="">Category Image</label><br>
            @if ($category->image)
                <span>Current Image</span>
                <img src="{{asset('storage/'.$category->image)}}" width="120px">
                <br><br>                
            @endif
            <input type="file" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            <div class="invalid-feedback">{{$errors->first('image')}}</div>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Update">
            <a class="btn btn-secondary" href="{{route('categories.index')}}">Cancel</a>
        </form>
    </div>

@endsection