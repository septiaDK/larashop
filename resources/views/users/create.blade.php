@extends("layouts.global")

@section("title") Create User @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Name</label>
    <input type="text" name="name" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" id="name" placeholder="name" value="{{old('name')}}">
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    <br>

    <label for="username">Username</label>
    <input type="text" class="form-control {{$errors->first('username') ? 'is-invalid' : ''}}" name="username" id="username" placeholder="username" value="{{old('username')}}">
    <div class="invalid-feedback">
        {{$errors->first('username')}}
    </div>
    <br>

    <label for="">Roles</label>
    <br>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="ADMIN" value="ADMIN"><label for="ADMIN">ADMIN</label>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="STAFF" value="STAFF"><label for="STAFF" style="margin-left: 18px;">STAFF</label>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="CUSTOMER" value="CUSTOMER"><label for="CUSTOMER" style="margin-left: 18px;">CUSTOMER</label>
    <div class="invalid-feedback">
        {{$errors->first('roles')}}
    </div>
    <br>
    <br>

    <label for="phone">Phone number</label>
    <input type="text" name="phone" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" id="phone" placeholder="phone number" value="{{old('phone')}}">
    <div class="invalid-feedback">
        {{$errors->first('phone')}}
    </div>
    <br>

    <label for="address">Address</label>
    <textarea name="address" class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}" id="address" cols="30" rows="3" placeholder="address">{{old('address')}}</textarea>
    <div class="invalid-feedback">
        {{$errors->first('address')}}
    </div>
    <br>

    <label for="avatar">Avatar image</label>
    <input type="file" name="avatar" class="form-control" id="avatar">
    <hr class="my-3">

    <label for="email">Email</label>
    <input type="text" name="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" id="email" placeholder="user@mail.com" value="{{old('email')}}">
    <div class="invalid-feedback">
        {{$errors->first('email')}}
    </div>
    <br>

    <label for="password">Password</label>
    <input type="password" name="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" id="password" placeholder="password" value="{{old('password')}}">
    <div class="invalid-feedback">
        {{$errors->first('password')}}
    </div>
    <br>

    <label for="password_confirmation">Password Confirmation</label>
    <input type="password" name="password_confirmation" class="form-control {{$errors->first('password_confirmation') ? 'is-invalid' : ''}}" id="password_confirmation" placeholder="password confirmation" value="{{old('password_confirmation')}}">
    <div class="invalid-feedback">
        {{$errors->first('password_confirmation')}}
    </div>
    <br>

    <div class="row">
        <div class="col-md-10">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
        <div class="col-md text-right">
            <a href="{{route('users.index')}}" class="text-right"> Kembali</a>
        </div>
    </div>
</form>
@endsection