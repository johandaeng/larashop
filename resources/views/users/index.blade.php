@extends('layouts.global')

@section('title')
    Users List
@endsection

@section('content')
    <div class="row">
      <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('users.create')}}">Create</a>
      </div>
      <div class="col-md-8">
        <form class="" action="{{route('users.index')}}">
          <div class="row">
            <div class="col-md-4">
              <input class="form-control" type="text" name="keyword" placeholder="Filter berdasarkan email" value="{{Request::get('keyword')}}">
            </div>
            <div class="col-md-4">
                <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} class="form-control" type="radio" name="status" id="active" value="ACTIVE">
                <label for="active">Active</label>
                <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} class="form-control" type="radio" name="status" id="inactive"value="INACTIVE">
                <label for="inactive">Inactive</label>
                <input class="btn btn-primary text-right" type="submit" name="" value="Filter">
          </div>
        </div>
      </form>
     </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{session('status')}}
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
                <th><b>Status</b>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->avatar)
                        <img src="{{asset('storage/'.$user->avatar)}}" width="70px">
                    @else
                     N/A
                    @endif

                </td>
                <td>
                  @if($user->status == "ACTIVE")
                  <span class="badge badge-success">{{$user->status}}</span>
                  @else
                  <span class="badge badge-danger">{{$user->status}}</span>
                  @endif
                </td>
                <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', ['id' => $user->id]) }}">Edit</a>
                <a class="btn btn-primary btn-sm" href="{{route('users.show', ['id' => $user->id])}}">Detail</a>
                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="{{route('users.destroy',['id'=>$user->id])}}" method="post">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <input class="btn btn-danger btn-sm" type="submit" name="" value="Delete">
                </form>
                </td>
            </tr>
            @endforeach
            <tfoot>
              <tr>
                <td colspan="10">{{$users->appends(Request::all())->links()}}</td>
              </tr>
            </tfoot>
        </tbody>
    </table>
@endsection
