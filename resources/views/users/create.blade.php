@extends('layouts.global')

@section('title')
    Create User
@endsection

@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"  action="{{route('users.store')}}" method="POST">
    @csrf
        <label for="name">Name</label>
        <input class="form-control {{$errors->first('name') ? "is-invalid": ""}}" type="text" name="name" id="name" placeholder="Full Name" value="{{old('name')}}">
        <div class="invalid-feedback">{{$errors->first('name')}}</div>
        <br>
        <label for="username">Username</label>
        <input class="form-control {{$errors->first('username') ? "is-invalid": ""}}" type="text" name="username" id="username" placeholder="Username" value="{{old('username')}}">
        <div class="invalid-feedback">{{$errors->first('username')}}</div>
        <br>
        <label for="">Roles</label>
        <br>
        <input class="form-control {{$errors->first('roles') ? "is-invalid": ""}}" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
        <label for="ADMIN">Administrator</label>
        <input class="form-control {{$errors->first('roles') ? "is-invalid": ""}}" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
        <label for="STAFF">Staff</label>
        <input class="form-control {{$errors->first('roles') ? "is-invalid": ""}}" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
        <label for="CUSTOMER">Customer</label>
        <div class="invalid-feedback">{{$errors->first('roles')}}</div>
        <br><br>
        <label for="phone">Phone Number</label>
        <input class="form-control {{$errors->first('phone') ? "is-invalid": ""}}" type="text" name="phone" id="phone" placeholder="Phone Number" value="{{old('phone')}}">
        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
        <br>
        <label for="address">Address</label>
        <textarea class="form-control {{$errors->first('address') ? "is-invalid": ""}}" name="address" id="address" placeholder="">{{old('address')}}</textarea>
        <div class="invalid-feedback">{{$errors->first('address')}}</div>
        <br>
        <label for="avatar">Avatar</label>
        <input class="form-control {{$errors->first('avatar') ? "is-invalid": ""}}" type="file" name="avatar" id="avatar" placeholder="">
        <div class="invalid-feedback">{{$errors->first('avatar')}}</div>
        <hr class="my-3">

        <label for="email">Email</label>
        <input class="form-control {{$errors->first('email') ? "is-invalid": ""}}" type="text" name="email" id="email" placeholder="user@mail.com" value="{{old('email')}}">
        <div class="invalid-feedback">{{$errors->first('email')}}</div>
        <br>
        <label for="password">Password</label>
        <input class="form-control {{$errors->first('password') ? "is-invalid": ""}}" type="password" name="password" id="password" placeholder="Password">
        <div class="invalid-feedback">{{$errors->first('password')}}</div>
        <br>
        <label for="password_confirmation">Password Confirmation</label>
        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid": ""}}" type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
        <div class="invalid-feedback">{{$errors->first('password_confirmation')}}</div>
        <br>
        <input class="btn btn-primary" type="submit" name="" id="" value="Save">
        <a class="btn btn-secondary" href="{{route('users.index')}}">Cancel</a>
    </form>
</div>
@endsection
