@extends('layouts.global')

@section('title')
    Category list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-primary" href="{{route('categories.create')}}">Create</a>
        </div>
        <div class="col-md-8">
            <form action="{{route('categories.index')}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Filter by category name">                
                            <div class="input-group-append">
                                 <input class="btn btn-primary" type="submit" value="Filter" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <a class="btn btn-primary active" href="{{route('categories.index')}}">Publish</a>
                            <a class="btn btn-default" href="{{route('categories.trash')}}">Trash</a>
                    </div>
                </div>
            </form>
        </div>        
    </div>
    <hr class="my-3">
   
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('status')}}
        </div>     
    @endif       
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Slug</b></th>
                <th><b>Image</b></th>
                <th><b>Actions</b></th>
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
                    @else
                        No image
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('categories.edit',['id' => $category->id])}}">Edit</a>
                    <a class="btn btn-primary btn-sm" href="{{route('categories.show',['id' => $category->id])}}">Show</a>
                    <form onsubmit="return confirm('Move category to trash?')" class="d-inline" action="{{route('categories.destroy', ['id' => $category->id])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Trash">
                    </form>
                </td>
            </tr>    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">{{$categories->appends(Request::all())->links()}}</td>
            </tr>
        </tfoot>
    </table>
@endsection