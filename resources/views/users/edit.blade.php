@extends("layouts.global")

@section('title') Edit User @endsection

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}" method="POST">
    @csrf
    <input type="hidden" value="PUT" name="_method">

    <label for="name">Name</label>
    <input type="text" name="name" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" id="name" placeholder="name" value="{{old('name') ? old('name') : $user->name}}">
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    <br>

    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="username" value="{{$user->username}}">
    <br>

    <label for="">Status</label>
    <br>
    <input type="radio" name="status" class="form-control" id="active" value="ACTIVE" {{($user->status == "ACTIVE") ? "checked" : ""}}><label for="active">ACTIVE</label>
    <input type="radio" name="status" class="form-control" id="inactive" value="INACTIVE" {{($user->status == "INACTIVE") ? "checked" : ""}}><label for="inactive">INACTIVE</label>
    <br>
    <br>

    <label for="">Roles</label>
    <br>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="ADMIN" value="ADMIN" {{in_array('ADMIN', json_decode($user->roles)) ? "checked" : ""}}><label for="ADMIN">ADMIN</label>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="STAFF" value="STAFF" {{in_array('STAFF', json_decode($user->roles)) ? "checked" : ""}}><label for="STAFF">STAFF</label>
    <input type="checkbox" name="roles[]" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" id="CUSTOMER" value="CUSTOMER" {{in_array('CUSTOMER', json_decode($user->roles)) ? "checked" : ""}}><label for="CUSTOMER">CUSTOMER</label>
    <div class="invalid-feedback">
        {{$errors->first('roles')}}
    </div>
    <br>
    <br>

    <label for="phone">Phone number</label>
    <input type="text" name="phone" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" id="phone" placeholder="phone number" value="{{old('phone') ? old('phone') : $user->phone}}">
    <div class="invalid-feedback">
        {{$errors->first('phone')}}
    </div>
    <br>

    <label for="address">Address</label>
    <textarea name="address" class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}" id="address" cols="30" rows="3" placeholder="address">{{old('address') ? old('address') : $user->address}}</textarea>
    <div class="invalid-feedback">
        {{$errors->first('address')}}
    </div>
    <br>

    <label for="avatar">Avatar image</label>
    <br>
    Current Avatar : <br>
    @if ($user->avatar)
    <img src="{{asset('storage/'. $user->avatar)}}" width="120px">
    <br>
    @else
    No Avatar
    @endif
    <br>
    <input type="file" name="avatar" class="form-control" id="avatar">
    <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
    <hr class="my-3">

    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="user@mail.com" value="{{$user->email}}">
    <br>

    <input type="submit" class="btn btn-primary" value="Save">
</form>
@endsection