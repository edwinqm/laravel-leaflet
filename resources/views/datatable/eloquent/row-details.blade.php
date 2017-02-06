@extends('layouts.master')

@section('title', 'RowDetails')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra1') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">RowDetails</div>
                    <div class="panel-body">

                        <table id="users-table" class="table table-condensed">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
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
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </tfoot>
                        </table>

                        <script id="details-template" type="text/x-handlebars-template">
                            <table class="table">
                                <tr>
                                    <td>Full name:</td>
                                    <td>@{{name}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>@{{email}}</td>
                                </tr>
                                <tr>
                                    <td>Extra info:</td>
                                    <td>And any further details here (images etc)...</td>
                                </tr>
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

        var table = $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! url('datatable/row-details-data') !!}',
                method: 'POST'
            },
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
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
        $('#user-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(template(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>
@endpush