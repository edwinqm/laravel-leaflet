@extends('layouts.master')

@section('title', 'Yajra-Example2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {!! Breadcrumbs::render('yajra2') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Yajra-Example2</div>
                    <div class="panel-body">



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