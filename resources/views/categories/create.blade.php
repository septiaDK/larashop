@extends("layouts.global")

@section("title") Create Category @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form class="bg-white shadow-sm p-3" action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Name</label>
    <input type="text" name="name" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" id="name" placeholder="name" value="{{old('name')}}">
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    <br>

    <div class="row">
        <div class="col-md-10">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
        <div class="col-md text-right">
            <a href="{{route('categories.index')}}" class="text-right"> Kembali</a>
        </div>
    </div>
</form>
@endsection