@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Cart</div>
                <div class="panel-body">
                    <table class="table text-capitalize">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub-Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        {{--*/ $totalQty = 0; $totalPrice = 0; /*--}}
                        @for($i = 0 ; $i < count($cart) ; $i++)
                        <tr>
                            <td><img src="{{ asset('img/pokemon/'.$cart[$i]['pokemon']->image) }}" width="100px"></td>
                            <td>{{ $cart[$i]['pokemon']->name }}</td>
                            <td>{{ $cart[$i]['quantity'] }}</td>
                            <td>{{ $cart[$i]['pokemon']->price }}</td>
                            <td>{{ $cart[$i]['pokemon']->price * $cart[$i]['quantity'] }}</td>
                            <td>
                                <form action="{{ url('/cart/'.$cart[$i]['pokemon']->id) }}" method="POST"> 
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }} 
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                            {{--*/
                                $totalQty += $cart[$i]['quantity']; 
                                $totalPrice = $cart[$i]['pokemon']->price * $cart[$i]['quantity'] 
                            /*--}}
                        </tr>
                        @endfor
                    </table>

                    <div class="lead text-center">
                        Total Quantity : {{ $totalQty }}
                    </div>
                    <div class="lead text-center">
                        Total Price : {{ $totalPrice }}
                    </div>
                    <div class="text-center">
                        <form action="{{ url('/transaction') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-lg btn-primary">Check Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
