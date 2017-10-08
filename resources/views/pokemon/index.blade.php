@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/pokemon') }}">
                        <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                <input id="search" type="text" class="form-control" name="search" placeholder="Search by name or element">

                                @if ($errors->has('search'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('search') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1" style="width:auto;">
                                <button class="btn btn-primary">Search</button>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="by">
                                    <option value="name">Name</option>
                                    <option value="element">Element</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="container text-capitalize" style="width: 100%;">
                        @foreach($pokemons as $pokemon)
                        <div style="display: inline-block; width: 24%; text-align: center; margin-right: 2px; margin-bottom: 5px;">
                            <div style="border: 1px solid #ddd; border-radius: 5px; text-align: center;">
                                <img src="{{ asset('img/pokemon/'.$pokemon->image) }}" width="90%">
                            </div>
                            <div style="text-align: center;"><strong>{{ $pokemon->name }}</strong></div>
                            <div>
                                @if(isset($action) && $action == 'update')
                                <a class="btn btn-primary" href="{{ url('admin/pokemon/update/'.$pokemon->id) }}">Update</a>
                                @elseif(isset($action) && $action == 'delete')
                                <form action="{{ url('admin/pokemon/delete/'.$pokemon->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                                @else
                                <a class="btn btn-primary" href="{{ url('pokemon/'.$pokemon->id) }}">Display</a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{ $pokemons->appends(['action'=> app('request')->input('action'), 'search' => app('request')->input('search'), 'by' => app('request')->input('by')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
