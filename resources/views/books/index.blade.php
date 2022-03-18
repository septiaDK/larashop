@extends("layouts.global")

@section("title") List Book @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form action="{{route('books.index')}}">
    <div class="row">
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" placeholder="Filter by title">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'books' ? 'active' : ''}}" href="{{route('books.index')}}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::get('status') == 'publish' ? 'active' : ''}}" href="{{route('books.index', ['status' => 'publish'])}}">Published</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}" href="{{route('books.index', ['status' => 'draft'])}}">Draft</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('books.trash')}}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('books.create')}}" class="btn btn-primary"> Create Book</a>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Cover</b></th>
            <th><b>Title</b></th>
            <th><b>Author</b></th>
            <th><b>Status</b></th>
            <th><b>Categories</b></th>
            <th><b>Stock</b></th>
            <th><b>Price</b></th>
            <th width="15%"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>
                @if ($book->cover)
                <img src="{{asset('storage/'. $book->cover)}}" width="70px">
                @else
                N/A
                @endif
            </td>
            <td>{{$book->title}}</td>
            <td>{{$book->author}}</td>
            <td>
                @if ($book->status == "PUBLISH")
                <span class="badge badge-success">{{$book->status}}</span>
                @else
                <span class="badge badge-dark">{{$book->status}}</span>
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
            <td>{{rupiah($book->price)}}</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('books.edit', [$book->id])}}">Edit</a>

                <form onsubmit="return confirm('Move book to trash?')" class="d-inline" action="{{route('books.destroy', [$book->id])}}" method="POST">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="TRASH" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">
                {{$books->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection