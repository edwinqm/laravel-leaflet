@extends('layouts.master')

@section('title', 'Yajra-Example1')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra1') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">DATATABLES</div>
                    <div class="panel-body">

                        <table class="table table-bordered" id="users-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>

<script>
    $(function () {
        $('#user-table').DataTable({
            responsive: {
                details: false
            },
            bJQueryUI: true,
            sPaginationType: "full_numbers",
            processing: true,
            serverSide: true,
            ajax: '{!! url('datatable/example1') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });
    });
</script>
@endpush