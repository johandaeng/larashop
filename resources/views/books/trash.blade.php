@extends('layouts.global')

@section('title')
    Trashed Books
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
    <div class="row">
        <div class="col-md-12">
          @if(session('status'))
          <div class="alert alert-success alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              {{session('status')}}
          </div>
          @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><b>Cover</b></th>
                        <th><b>Title</b></th>
                        <th><b>Author</b></th>
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
                                <ul class="pl-3">
                                    @foreach ($book->categories as $category)
                                    <li>{{$category->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$book->stock}}</td>
                            <td>{{$book->price}}</td>
                            <td>
                                <form class="d-inline" action="{{route('books.restore',['id' =>$book->id])}}" method="post">
                                  @csrf
                                  <input type="submit" name="" value="Restore" class="btn btn-success btn-sm">
                                </form>

                                <form onsubmit="return confirm('Delete this book permanently?')" class="d-inline" action="{{route('books.delete-permanent',['id'=>$book->id])}}" method="post">
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
                        {{$books->appends(Request::all())->links()}}
                    </td>
                </tfoot>
            </table>

        </div>
    </div>

@endsection
