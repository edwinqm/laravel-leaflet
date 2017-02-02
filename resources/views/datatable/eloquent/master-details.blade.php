@extends('layouts.master')

@section('title', 'Master-Details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra5') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Master-Details</div>
                    <div class="panel-body">


                        <table id="users-table" class="table table-condensed">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Posts</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Posts</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </tfoot>
                        </table>

                        <script id="details-template" type="text/x-handlebars-template">
                            <div class="label label-info">User @{{ name }}'s Posts</div>
                            <table class="table details-table" id="posts-@{{id}}">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                            </table>
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
        var template = Handlebars.compile($("#details-template").html());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('datatable/master-data') !!}',
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'id', name: 'users.id'},
                {data: 'name', name: 'users.name', searchable: false},
                {data: 'email', name: 'users.email'},
                {data: 'count', name: 'count', searchable: false},
                {data: 'created_at', name: 'users.created_at'},
                {data: 'updated_at', name: 'users.updated_at'},
            ],
            order: [[1, 'asc']],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                });
            }
        });

        // Add event listener for opening and closing details
        $('#users-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'posts-' + row.data().id;

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                initTable(tableId, row.data());
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });

        function initTable(tableId, data) {
            console.log(data.details_url + '/' + data.id)
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: data.details_url,
                    method: 'POST',
                    data: {id: data.id}
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'}
                ]
            });
        }
    });
</script>
@endpush