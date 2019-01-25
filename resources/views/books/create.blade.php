@extends('layouts.global')

@section('title')
    Create book
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <form enctype="multipart/form-data" class="shadow-sm p-3 bg-white" action="{{route('books.store')}}" method="post">
            @csrf
            <label for="title">Title</label><br>
            <input type="text" class="form-control {{$errors->first('title') ? "is-invalid" : ""}}" name="title" id="title" value="{{old('title')}}">
            <div class="invalid-feedback">{{$errors->first('title')}}</div>
            <br>
            <label for="cover">Cover</label><br>
            <input type="file" class="form-control {{$errors->first('cover') ? "is-invalid" : ""}}" name="cover" id="cover">
            <div class="invalid-feedback">{{$errors->first('cover')}}</div>
            <br>
            <label for="description">Description</label><br>
            <textarea id="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" name="description" placeholder="Give a description about this book" value="">{{old('description')}}</textarea>
            <div class="invalid-feedback">{{$errors->first('description')}}</div>
            <br>
            <label for="categories">Categories</label><br>
            <select class="form-control" name="categories[]" id="categories"  multiple></select>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" value="{{old('stock')}}" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" id="stock" placeholder="" min="0"  value="0">
            <div class="invalid-feedback">{{$errors->first('stock')}}</div>
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}}" name="author" id="author" placeholder="Book author" value={{old('author')}}"">
            <div class="invalid-feedback">{{$errors->first('author')}}</div>
            <br>
            <label for="publisher">Publisher</label><br>
            <input type="text" class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}" name="publisher" id="publisher" placeholder="Book publisher" value="{{old('publisher')}}">
            <div class="invalid-feedback">{{$errors->first('publisher')}}</div>
            <br>
            <label for="price">Price</label><br>
            <input type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price" placeholder="" value="{{old('price')}}">
            <div class="invalid-feedback">{{$errors->first('price')}}</div>
            <br>
            <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
            <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
            <a class="btn btn-light" href="{{route('books.index')}}">Cancel</a>
        </form>
    </div>
</div>
@endsection

@section('footer-scripts')
    <link rel="stylesheet" href="{{asset('polished/select2.min.css')}}">
    <script src="{{asset('polished/select2.min.js')}}"></script>
    <script>
        $('#categories').select2({
            ajax: {
                url: 'http://localhost:8000/ajax/categories/search',
                processResults: function(data){
                    return {
                        results: data.map(function(item) {
                            return {id: item.id, text: item.name}})
                    }
                }
            }
        });
    </script>
@endsection
