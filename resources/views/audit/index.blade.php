@extends('layouts.master')

@section('title', 'Audits')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{--{!! Breadcrumbs::render('') !!}--}}

                <div class="panel panel-default">
                    <div class="panel-heading">Audits</div>
                    <div class="panel-body">

                        {{--datatable--}}
                        <table class="table table-bordered" width="100%" id="audit-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>TYPE</th>
                                <th>AUDITABLE TYPE</th>
                                <th>AUDITABLE ID</th>
                                <th>CREATED AT</th>
                            </tr>
                            </thead>
                        </table>
                        {{--end datatable--}}

                        {{--details template--}}
                        <script id="details-template" type="text/x-handlebars-template">
                            <table class="table">
                                <tr>
                                    <td>NEW</td>
                                    <td>@{{ new }}</td>
                                </tr>
                                <tr>
                                    <td>OLD</td>
                                    <td>@{{ old }}</td>
                                </tr>
                                <tr>
                                    <td>USER</td>
                                    <td>@{{ user_id }}</td>
                                </tr>
                                <tr>
                                    <td>ROUTE</td>
                                    <td>@{{ route }}</td>
                                </tr>
                                <tr>
                                    <td>IP</td>
                                    <td>@{{ ip_address }}</td>
                                </tr>
                            </table>
                        </script>
                        {{--end details template--}}

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

        var table = $('#audit-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{!! url('audits') !!}',
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'id', name: 'id', "data-hide": 'phone'},
                {data: 'type', name: 'type'},
                {data: 'auditable_type', name: 'auditable_type'},
                {data: 'auditable_id', name: 'auditable_id'},
                {data: 'created_at', name: 'created_at'},
            ],
            order: [[5, 'desc']]
        });

        // Add event listener for opening and closing details
        $('#audit-table tbody').on('click', 'td.details-control', function () {
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