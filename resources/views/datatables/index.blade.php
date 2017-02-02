@extends('layouts.app')

@section('title', 'DATATABLES')

@include('_partials.head')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">DATATABLES</div>
                    <div class="panel-body">

                        {{ link_to('nayjest/index', 'Nayjest/Grids', ['class' => 'btn btn-primary'], null) }}

                        {{ link_to('datatable/index', 'Yajra', ['class' => 'btn btn-success'], null) }}

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