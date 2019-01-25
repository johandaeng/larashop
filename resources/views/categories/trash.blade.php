@extends('layouts.global')

@section('title')
    Trashed Categories
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('categories.index')}}">
                <div class="input-group">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Filter by category name" value="{{Request::get('name')}}">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="Filter">
                    </div>
                </div>            
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Slug</b></th>
                        <th><b>Image</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)                    
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{asset('storage/'.$category->image)}}" width="48px">
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{route('categories.restore', ['id' => $category->id])}}">Restore</a>
                                <form onsubmit="return confirm('Delete this category permanently?')" class="d-inline" action="{{route('categories.delete-permanent',['id'=>$category->id])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="10">
                        {{$categories->appends(Request::all())->links()}}
                    </td>
                </tfoot>
            </table>

        </div>
    </div>

@endsection