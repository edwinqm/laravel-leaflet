@extends('layouts.master2')

@section('title', 'UserCreate')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{--                {!! Breadcrumbs::render('') !!}--}}

                <div class="panel panel-default">
                    <div class="panel-heading">Add a new User</div>
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-12">

                                @include('_partials.alerts.errors')

                                @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('flash_message') }}
                                    </div>
                                @endif

                            </div>

                            {!! Form::open([
                                        'route' => 'user.store',
                                        'id' => 'user-form',
                                    ]) !!}

                            <div class="col-md-6">
                                <p class="page-header">User</p>

                                <div class="form-group">
                                    {!! Form::label('username', 'Username:', ['class' => 'control-label', ]) !!}
                                    {!! Form::text('username', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name','Name:', ['class' => 'control-label', ]) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', 'Email:', ['class' => 'control-label', ]) !!}
                                    {!! Form::email('email', null, ['class' => 'form-control', ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password', 'Password:', ['class' => 'control-label', ]) !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Password Confirmation:', ['class' => 'control-label', ]) !!}
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
                                </div>

                            </div>

                            <div class="col-md-6">
                                <p class="page-header">Profile</p>

                                <div class="form-group">
                                    {!! Form::label('address', 'Address:', ['class' => 'control-label', ]) !!}
                                    {!! Form::text('address', null, ['class' => 'form-control', ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('phone', 'Phone:', ['class' => 'control-label', ]) !!}
                                    {!! Form::text('phone', null, ['class' => 'form-control', ]) !!}
                                </div>

                                {!! Form::submit('Create New User', ['class' => 'btn btn-primary' ]) !!}

                            </div>


                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\UserFormRequest', '#user-form') !!}
@endpush