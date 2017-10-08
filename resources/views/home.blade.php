@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to PokeMart <span style="float:right;">{{ \Carbon\Carbon::now()->format('D d M Y') }}</span></div>

                <div class="panel-body">
                    PokeMart is where you buy and abuse pokemon
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
