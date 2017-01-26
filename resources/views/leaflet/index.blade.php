@extends('layouts.app')

@section('title', 'Leaflet-Index')


@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Breadcrumbs::render('home') !!}

                <div class="panel panel-default">
                    <div class="panel-heading">LEAFLET MAPS</div>

                    <div class="panel-body">

                        {{ link_to_route('maps.leaflet.basic', 'BASIC', [], ['class' => 'btn btn-default', ]) }}

                        {{ link_to_route('maps.leaflet.prune-categories', 'PRUNE CATEGORIES', [], ['class' => 'btn btn-success', ]) }}

                        {{ link_to_route('maps.leaflet.prune-cluster', 'PRUNE CLUSTER', [], ['class' => 'btn btn-danger', ]) }}

                        {{ link_to_route('maps.leaflet.prune-control', 'PRUNE CONTROL', [], ['class' => 'btn btn-warning', ]) }}

                        {{ link_to_route('maps.tracking', 'TRACKING', [], ['class' => 'btn btn-primary', ]) }}

                        {{ link_to_route('maps.tracking2', 'TRACKING 2', [], ['class' => 'btn btn-primary', ]) }}

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

