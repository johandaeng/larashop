@extends('layouts.global')

@section('title')
    Edit book
@endsection

@section('content')
    <div class="row">
       <div class="col-md-8">
        <form enctype="multipart/form-data" class="shadow-sm p-3 bg-white" action="{{route('books.update',['id' => $book->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <label for="title">Title</label><br>
            <input type="text" class="form-control {{$errors->first('title') ? "is-invalid" : ""}}" name="title" id="title" placeholder="Book title" value="{{old('title') ? old('title') : $book->title}}">
            <div class="invalid-feedback">{{$errors->first('title')}}</div>
            <br>
            <label for="cover">Cover</label><br>
            <small class="text-muted">Current cover</small> <br>
            @if ($book->cover)
                <img src="{{asset('storage/'.$book->cover)}}" width="96px">
            @endif
            <br><br>
            <input type="file" class="form-control" name="cover" id="cover">
            <small class="text-muted">Kosongkan jika tidak mengubah cover</small>
            <br><br>
            <label for="slug">Slug</label><br>
            <input class="form-control {{$errors->first('slug') ? "is-invalid" : ""}}" type="text" name="slug" id="slug" placeholder="enter-a-slug" value="{{old('slug') ? old('slug') : $book->slug}}">
            <div class="invalid-feedback">{{$errors->first('slug')}}</div>
            <br>
            <label for="description">Description</label><br>
            <textarea id="description" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" name="description" placeholder="Give a description about this book">{{old('description') ? old('description') : $book->description}}</textarea>
            <div class="invalid-feedback">{{$errors->first('description')}}</div>
            <br>
            <label for="categories">Categories</label><br>
            <select class="form-control" name="categories[]" id="categories" multiple></select>
            <br>
            <label for="stock">Stock</label><br>
            <input type="number" class="form-control {{$errors->first('stock') ? "is-invalid" : ""}}" name="stock" id="stock" placeholder="" value="{{old('stock') ? old('stock') : $book->stock}}">
            <div class="invalid-feedback">{{$errors->first('stock')}}</div>
            <br>
            <label for="author">Author</label><br>
            <input type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}}" name="author" id="author" placeholder="Book author" value="{{old('author') ? old('author') : $book->author}}">
            <div class="invalid-feedback">{{$errors->first('author')}}</div>
            <br>
            <label for="publisher">Publisher</label><br>
            <input type="text" class="form-control {{$errors->first('publisher') ? "is-invalid" : ""}}" name="publisher" id="publisher" placeholder="Book publisher" value="{{old('publisher') ? old('publisher') : $book->publisher}}">
            <div class="invalid-feedback">{{$errors->first('publisher')}}</div>
            <br>
            <label for="price">Price</label><br>
            <input type="number" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="price" id="price" placeholder="" value="{{old('price') ? old('price') : $book->price}}">
            <div class="invalid-feedback">{{$errors->first('price')}}</div>
            <br>
            <label for="">Status</label>
            <select name="status" id="status" class="form-control {{$errors->first('status') ? "is-invalid" : ""}}">
                <option {{$book->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
                <option {{$book->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
            </select>
            <br>

            <button class="btn btn-primary" value="PUBLISH">Update</button>
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

        var categories = {!! $book->categories !!}
            categories.forEach(function(category){
                var option = new Option(category.name, category.id, true, true);
                $('#categories').append(option).trigger('change');
            });
    </script>
@endsection
