@extends('layouts.master')

@section('title', 'Yajra-Examples')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Yajra-Examples</div>
                    <div class="panel-body">

                        {{ link_to_route('datatable.example1', 'Basic', []) }}
{{--                        || {{ link_to('datatable/row-details', 'Example 2', []) }}--}}
                        || {{ link_to_route('datatable.row-details', 'Row Details', []) }}
                        || {{ link_to('users', 'DataTables as a Service', []) }}
                        || {{ link_to('datatable/post-column-search', 'Filter Column', []) }}
                        || {{ link_to('datatable/master-details', 'Master Details', []) }}
                        || {{ link_to('datatable/count', 'Count Alias', []) }}
                        || {{ link_to('services/two-datatables', 'Service TwoDatatables', []) }}
                        || {{ link_to('datatable/responsive', 'Responsive', []) }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $(function () {

    });
</script>
@endpush