@extends('layouts.master')

@section('title', 'Yajra-Other')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra3') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Yajra-Other</div>
                    <div class="panel-body">

                        {!! $dataTable->table() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush