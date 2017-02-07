@extends('layouts.master2')

@section('title', 'User List')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{--                {!! Breadcrumbs::render('') !!}--}}

                <div class="panel panel-default">
                    <div class="panel-heading">User List</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">


                                @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('flash_message') }}
                                    </div>
                                @endif

                                {!! link_to_route('user.create', 'Add User', null, ['class' => 'btn btn-success']) !!}

                            </div>

                            <div class="col-md-12 text-center">

                                @foreach($users as $user)

                                    <h3>{{ $user->id.' | '.$user->username }}</h3>

                                    <p>{{ $user->email }}</p>

                                    <p>
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                    </p>
                                    <hr>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>

</script>
@endpush