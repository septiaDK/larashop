@extends("layouts.global")

@section("title") List User @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form action="{{route('users.index')}}">
    <div class="row">
        <div class="col-md-5">
            <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" placeholder="Filter berdasarkan email">
        </div>
        <div class="col-md-6">
            <input type="radio" name="status" class="form-control" id="active" value="ACTIVE" {{Request::get('status') == "ACTIVE" ? 'checked' : ""}}><label for="active">ACTIVE</label>
            <input type="radio" name="status" class="form-control" id="inactive" value="INACTIVE" {{Request::get('status') == "INACTIVE" ? 'checked' : ""}}><label for="inactive">INACTIVE</label>

            <input type="submit" value="Filter" class="btn btn-primary">
        </div>

    </div>
</form>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('users.create')}}" class="btn btn-primary"> Create User</a>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Username</b></th>
            <th><b>Email</b></th>
            <th><b>Avatar</b></th>
            <th><b>Status</b></th>
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
                @if ($user->avatar)
                <img src="{{asset('storage/'. $user->avatar)}}" width="70px">
                @else
                N/A
                @endif
            </td>
            <td>
                @if ($user->status == "ACTIVE")
                <span class="badge badge-success">ACTIVE</span>
                @else
                <span class="badge badge-danger">INACTIVE</span>
                @endif
            </td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>

                <form onsubmit="return confirm('Delete this user?')" class="d-inline" action="{{route('users.destroy', [$user->id])}}" method="POST">
                    @csrf

                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10">
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection