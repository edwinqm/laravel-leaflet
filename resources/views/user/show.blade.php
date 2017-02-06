@extends('layouts.master2')

@section('title', 'Show User')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{--                {!! Breadcrumbs::render('') !!}--}}

                <div class="panel panel-default">
                    <div class="panel-heading">Show User</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">

                                <h1 class="page-header">{{ $user->username }}</h1>

                                <p class="lead">{{ $user->name }}</p>
                                <p class="lead">{{ $user->email }}</p>
                                <p class="lead">{{ $user->profile->address }}</p>

                                <p>
                                    <a href="{{ route('user.index') }}" class="btn btn-success">Back</a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <div>
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['user.destroy', $user->id],
                                    ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop