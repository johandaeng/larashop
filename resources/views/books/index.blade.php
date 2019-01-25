@extends('layouts.global')

@section('title')
    Book list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <a class="btn btn-primary" href="{{route('books.create')}}">Create</a>
        </div>
        <div class="col-md-4">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{route('books.index')}}" class="nav-link {{Request::get('status') == NULL && Request::path() == 'books' ? 'active' : ''}}">All</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.index',['status' => 'publish'])}}" class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}} ">Publish</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.index',['status' => 'draft'])}}" class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}">Draft</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('books.trash')}}" class="nav-link {{Request::path() == 'books/trash' ? 'active' : ''}}">Trash</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
          <form class="" action="{{route('books.index')}}">
            <div class="input-group">
              <input class="form-control" type="text" name="keyword" placeholder="Filter by title" value="{{Request::get('keyword')}}">
              <div class="input-group-append">
                <input class="btn btn-primary" type="submit" name="" value="Filter">
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
                        <th><b>Cover</b></th>
                        <th><b>Title</b></th>
                        <th><b>Author</b></th>
                        <th><b>Status</b></th>
                        <th><b>Categories</b></th>
                        <th><b>Stock</b></th>
                        <th><b>Price</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>
                            @if ($book->cover)
                                <img src="{{asset('storage/'.$book->cover)}}" width="96px">
                            @endif
                        </td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>
                            @if ($book->status == "DRAFT")
                                <span class="badge bg-dark text-white">{{$book->status}}</span>
                            @else
                                <span class="bage badge-success">{{$book->status}}</span>
                            @endif
                        </td>
                        <td>
                            <ul class="pl-3">
                                @foreach ($book->categories as $category)
                                    <li>{{$category->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$book->stock}}</td>
                        <td>{{$book->price}}</td>
                        <td>
                            <a href="{{route('books.edit',['id' => $book->id])}}" class="btn btn-info btn-sm">Edit</a>
                            <form onsubmit="return confirm('Move book to trash?')" action="{{route('books.destroy',['id' => $book->id])}}" class="d-inline" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            {{$books->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
@endsection
