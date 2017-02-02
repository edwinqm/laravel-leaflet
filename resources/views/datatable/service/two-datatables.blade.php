@extends('layouts.master')

@section('title', 'Service-TwoDatatables')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra7') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Service-TwoDatatables</div>
                    <div class="panel-body">

                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#users" role="tab" data-toggle="tab">
                                        <icon class="fa fa-home"></icon>
                                        Users
                                    </a>
                                </li>
                                <li>
                                    <a href="#posts" role="tab" data-toggle="tab" onclick="postsDataTables()">
                                        <i class="fa fa-user"></i>Posts
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="users">
                                    <?php echo $dataTable->table(['class' => 'table table-bordered table-condensed']); ?>

                                </div>
                                <div class="tab-pane fade" id="posts">
                                    <table class="table table-bordered table-condensed" id="postsTable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created By</th>
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
            </div>
        </div>
    </div>
@stop

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
<script>
    function postsDataTables() {
        if (!$.fn.dataTable.isDataTable('#postsTable')) {
            $('#postsTable').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                buttons: [
                    'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
                ],
                ajax: '{!! url('/services/two-datatables/posts') !!}',
                columns: [
                    {data: 'id', name: 'posts.id'},
                    {data: 'title', name: 'posts.title'},
                    {data: 'description', name: 'posts.description'},
                    {data: 'created_by', name: 'users.name', width: '110px'},
                    {data: 'created_at', name: 'posts.created_at', width: '120px'},
                    {data: 'updated_at', name: 'posts.updated_at', width: '120px'},
                ],
                order: [[0, 'desc']]
            });
        }
    }
</script>
@endpush