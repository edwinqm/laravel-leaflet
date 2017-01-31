@extends('layouts.app')

@section('title', 'List of UsersGS Basic')

@include('partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{{--{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}--}}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{{--{!! Html::script('leaflet/js/PruneCluster.js') !!}--}}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">GS USERS</div>
                    <div class="panel-body map-container">


                        <?php
                        $cfg = [
                                'src' => 'App\User',
                                'columns' => [
                                        'name',
                                        'email',
                                ]
                        ];
                        echo \Nayjest\Grids\Grids::make($cfg);

                        ?>


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