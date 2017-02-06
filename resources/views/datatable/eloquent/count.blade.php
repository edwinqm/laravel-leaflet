@extends('layouts.master')

@section('title', 'Count Alias')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra6') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Count Alias</div>
                    <div class="panel-body">

                        <table id="users-table" class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th># of Post</th>
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
<script>
    $(function () {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('datatable/count-data') !!}',
            columns: [
                {data: 'id', name: 'user.id'},
                {data: 'name', name: 'user.name'},
                {data: 'email', name: 'user.email'},
                {data: 'count', name: 'count', searchable: false},
                {data: 'created_at', name: 'user.created_at'},
                {data: 'updated_at', name: 'user.updated_at'}
            ]
        });
    });
</script>
@endpush