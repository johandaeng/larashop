@extends('layouts.global')

@section('title')
    Detail Category
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <label for=""><b>Category name</b></label><br>
                {{$category->name}}
                <br><br>
                <label for=""><b>Category slug</b></label><br>
                {{$category->slug}}
                <br><br>
                <label for=""><b>Category image</b></label><br>
                @if ($category->image)
                    <img src="{{asset('storage/'.$category->image)}}" width="120px">
                @endif
                <br>
                <a class="btn btn-secondary" href="{{route('categories.index')}}">Cancel</a>
            </div>
        </div>
    </div>

@endsection