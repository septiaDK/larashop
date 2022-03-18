@extends("layouts.global")

@section("title") List Order @endsection

@section("content")
<form action="{{route('orders.index')}}">
    <div class="row">
        <div class="col-md-5">
            <input type="text" name="buyer_email" class="form-control" value="{{Request::get('buyer_email')}}" placeholder="Search by buyer email">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control" id="status">
                <option value="">ANY</option>
                <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="PROCESS">FINISH</option>
                <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="PROCESS">CANCEL</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" class="btn btn-primary" value="Filter">
        </div>
    </div>
</form>
<hr class="my-3">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Invoice Number</th>
            <th><b>Status</b></th>
            <th><b>Buyer</b></th>
            <th><b>Total quantity</b></th>
            <th><b>Order date</b></th>
            <th><b>Total price</b></th>
            <th width="15%"><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->invoice_number}}</td>
            <td>
                @if($order->status == "SUBMIT")
                <span class="badge bg-warning text-light">{{$order->status}}</span>
                @elseif ($order->status == "PROCESS")
                <span class="badge bg-info text-light">{{$order->status}}</span>
                @elseif ($order->status == "FINISH")
                <span class="badge bg-success text-light">{{$order->status}}</span>
                @elseif ($order->status == "CANCEL")
                <span class="badge bg-dark text-light">{{$order->status}}</span>
                @endif
            </td>
            <td>
                {{$order->user->username}} <br>
                <small>{{$order->user->email}}</small>
            </td>
            <td>{{$order->totalQuantity}} pc (s)</td>
            <td>{{$order->created_at}}</td>
            <td>{{rupiah($order->total_price)}}</td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('orders.edit', [$order->id])}}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">
                {{$orders->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection