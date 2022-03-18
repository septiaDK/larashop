@extends("layouts.global")

@section("title") Create Category @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form class="bg-white shadow-sm p-3" action="{{route('categories.update', [$category->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="PUT" name="_method">

    <label for="name">Name</label>
    <input type="text" name="name" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" id="name" placeholder="name" value="{{old('name') ? old('name') : $category->name}}">
    <div class="invalid-feedback">
        {{$errors->first('name')}}
    </div>
    <br>

    <label for="slug">Slug</label>
    <input type="text" name="slug" class="form-control {{$errors->first('slug') ? 'is-invalid' : ''}}" id="slug" placeholder="slug" value="{{old('slug') ? old('slug') : $category->slug}}">
    <div class="invalid-feedback">
        {{$errors->first('slug')}}
    </div>
    <br>

    <input type="submit" class="btn btn-primary" value="Save">
</form>
@endsection