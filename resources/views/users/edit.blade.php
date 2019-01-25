@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
<div class="col-md-8">
  @if(session('status'))
  <div class="alert alert-success">
    {{session('status')}}
  </div>
  @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', ['id'=>$user->id])}}" method="post">
      @csrf
      <input type="hidden" value="PUT" name="_method">
      <label for="name">Name</label>
      <input class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" type="text" name="name" id="name" placeholder="Full Name" value="{{old('name') ? old('name') : $user->name}}">
      <div class="invalid-feedback">{{$errors->first('name')}}</div>
      <br>
      <label for="username">Username</label>
      <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="{{$user->username}}" disabled>
      <br>
      <label for="">Status</label>
      <br>
      <input {{$user->status == "ACTIVE" ? "checked" : ""}} class="form-control" type="radio" id="active" name="status" value="ACTIVE">
      <label for="active">Active</label>
      <input {{$user->status == "INACTIVE" ? "checked" : ""}} class="form-control" type="radio" id="inactive" name="status" value="INACTIVE">
      <label for="inactive">Inactive</label>
      <br><br>
      <label for="">Roles</label>
      <br>
      <input class="form-control {{$errors->first('roles') ? "is-invalid" : ""}}" type="checkbox" {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="ADMIN" value="ADMIN">
      <label for="ADMIN">Administrator</label>
      <input class="form-control {{$errors->first('roles') ? "is-invalid" : ""}}" type="checkbox" {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="STAFF" value="STAFF">
      <label for="STAFF">Staff</label>
      <input class="form-control {{$errors->first('roles') ? "is-invalid" : ""}}" type="checkbox" {{in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="CUSTOMER" value="CUSTOMER">
      <label for="CUSTOMER">Customer</label>
      <div class="invalid-feedback">{{$errors->first('roles')}}</div>
      <br><br>
      <label for="phone">Phone Number</label>
      <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone Number" value="{{old('phone') ? old('phone') : $user->phone}}">
      <div class="invalid-feedback">{{$errors->first('phone')}}</div>
      <br>
      <label for="address">Address</label>
      <textarea class="form-control {{$errors->first('address') ? "is-invalid" : ""}}" name="address" id="address" placeholder="">{{old('address') ? old('address') : $user->address}}</textarea>
      <div class="invalid-feedback">{{$errors->first('address')}}</div>
      <br>
      <label for="avatar">Avatar Image</label>
      <br>
      Current avatar : <br>
      @if($user->avatar)
      <img src="{{asset('storage/'.$user->avatar)}}" width="120px">
      <br>
      @else
        No avatar
      @endif
      <br>
      <input class="form-control" type="file" name="avatar" id="avatar" placeholder="">
      <small class="text-muted">Kosongkan jika tidak ingin merubah avatar</small>

      <hr class="my-3">

      <label for="email">Email</label>
      <input class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" type="text" name="email" id="email" placeholder="user@mail.com" value="{{$user->email}}" disabled>
      <div class="invalid-feedback">{{$errors->first('email')}}</div>    
      <br>
      <input class="btn btn-primary" type="submit" name="" id="" value="Save">
      <a class="btn btn-secondary" href="{{route('users.index')}}">Cancel</a>
    </form>
  </div>
@endsection
