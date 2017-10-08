@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-capitalize">{{ $action }} Transaction</div>
                <div class="panel-body">
                    <table class="table text-capitalize">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th colspan="{{ $action == 'update' ? '3' : '1' }}"></th>
                            </tr>
                        </thead>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->email }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->status }}</td>
                            @if($action == 'update')
                            <td colspan="3">
                                <form method="POST" action="{{ url('admin/transaction') }}" style="display: inline-block;"> 
                                    {{ csrf_field()}} 
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="id" value="{{ $transaction->id }}">
                                    <input type="hidden" name="status" value="accept">
                                    <button class="btn btn-success">Accept</button>
                                </form>
                                <form method="POST" action="{{ url('admin/transaction') }}" style="display: inline-block;"> 
                                    {{ csrf_field()}} 
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="id" value="{{ $transaction->id }}">
                                    <input type="hidden" name="status" value="decline">
                                    <button class="btn btn-warning">Decline</button>
                                </form>
                                <a class="btn btn-primary" href="{{ url('admin/transaction/detail/'.$transaction->id) }}">Detail</a>
                            </td>
                            @elseif($action == 'delete')
                            <td>
                                <form method="POST" action="{{ url('admin/transaction') }}" style="display: inline-block;"> 
                                    {{ csrf_field()}} 
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="id" value="{{ $transaction->id }}">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            @else
                            <td>
                                 <a class="btn btn-primary" href="{{ url('transaction/detail/'.$transaction->id) }}">Detail</a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
