@extends("layouts.global")

@section("title") List Category @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form action="{{route('categories.index')}}">
    <div class="row">
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" value="{{Request::get('name')}}" name="name" class="form-control col-md-10" placeholder="Filter berdasarkan">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('categories.create')}}" class="btn btn-primary"> Create Category</a>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Slug</b></th>
            <th width="15%"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $categori)
        <tr>
            <td>{{$categori->name}}</td>
            <td>{{$categori->slug}}</td>
            <td>
                <a class="btn btn-success text-white btn-sm" href="{{route('categories.restore', [$categori->id])}}">Restore</a>

                <form onsubmit="return confirm('Delete this category permanently?')" class="d-inline" action="{{route('categories.delete-permanent', [$categori->id])}}" method="POST">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="DELETE" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                {{$categories->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection