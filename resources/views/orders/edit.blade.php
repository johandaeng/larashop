@extends('layouts.global')

@section('title')
    Edit Order
@endsection

@section('content')
  <div class="col-md-8">
    <form class="shadow-sm bg-white p-3" action="{{route('orders.update',['id' => $order->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT"><br>
        <label for="invoice_number">Invoice Number</label>
        <input type="text" class="form-control" name="" value="{{$order->invoice_number}}" disabled>
        <br>
        <label for="">Buyer</label><br>
        <input type="text" class="form-control" name="" value="{{$order->user->name}}" disabled>
        <br>
        <label for="created_at">Order Date</label><br>
        <input type="text" class="form-control" name="" value="{{$order->created_at}}" disabled>
        <br>
        <label for="">Books ({{$order->totalQuantity}})</label><br>
        <ul>
          @foreach ($order->books as $book)
            <li>{{$book->title}} <b>{{$book->pivot->quantity}}</b></li>
          @endforeach
        </ul>

        <label for="">Total price</label> <br>
        <input type="text" class="form-control" name="" value="{{$order->total_price}}" disabled>
        <br>
        <label for="status">Status</label><br>
        <select class="form-control" name="status" id="status">
          <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
          <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
          <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
          <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
        </select>
        <br>
        <input type="submit" class="btn btn-primary" name="" value="Update">
        <a class="btn btn-secondary" href="{{route('orders.index')}}">Cancel</a>
    </form>
  </div>
@endsection
