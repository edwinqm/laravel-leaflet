@extends('layouts.app')

@section('title', 'index')

@include('partials.head')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">index</div>
                    <div class="panel-body">

                        {{ link_to_route('nayjest.example1', 'Examle 1', []) }}
                        || {{ link_to_route('nayjest.example2', 'Example 2', []) }}
                        || {{ link_to_route('nayjest.example3', 'Example 3', []) }}
                        || {{ link_to_route('nayjest.example4', 'Example 4', []) }}

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