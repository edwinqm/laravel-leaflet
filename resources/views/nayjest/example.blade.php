@extends('layouts.app')

@section('title', $text)

@include('_partials.head')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if(isset($breadcrumbs))
                    {!! Breadcrumbs::render($breadcrumbs) !!}
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading"><b>{!! $text !!}</b></div>
                    <div class="panel-body">

                        {!! $grid !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>

    </script>
@stop