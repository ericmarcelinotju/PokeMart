@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-capitalize">{{ $pokemon->name }}</div>
                <div class="panel-body text-capitalize">
                    <div class="text-center">
                        <img src="{{ asset('img/pokemon/'.$pokemon->image) }}" width="40%">
                    </div>
                    <dl class="dl-horizontal" style="padding-left: 26%;">
                        <dt>Price</dt>
                        <dd>{{ $pokemon->price }}</dd>
                        <dt>Element</dt>
                        <dd>{{ $pokemon->element->name }}</dd>
                        <dt>Gender</dt>
                        <dd>{{ $pokemon->gender }}</dd>
                    </dl>
                    <p>{{ $pokemon->description }}</p>
                    <br>
                    <strong>Comments :</strong>
                    <hr>
                    <div style="height: 80px; overflow-y: scroll;">
                        @foreach($pokemon->comments as $comment)
                        <div style="margin-bottom: 5px;">
                            <div><strong>{{ $comment->user->email }} <span style="float: right;">{{ $comment->created_at }}</span></strong></div>
                            <div>{{ $comment->content }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div style="margin-top: 20px;">
                        <form class="form-horizontal" method="POST" action="{{ url('/cart') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-2 control-label" style="padding-left: 61px;">Quantity</label>

                                <div class="col-md-2">
                                    <input id="quantity" type="number" class="form-control" name="quantity">
                                </div>
                                <button class="btn btn-primary col-md-7">Add to Cart</button>
                                @if ($errors->has('quantity'))
                                <span class="help-block col-md-12 text-center">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div style="text-align: center;">
                        <form class="form-horizontal" method="POST" action="{{ url('/comment') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <div class="col-md-7 col-md-offset-1">
                                    <input id="comment" type="text" class="form-control" name="comment" placeholder="Your Comment">

                                    @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button class="btn btn-primary col-md-3">Insert Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
