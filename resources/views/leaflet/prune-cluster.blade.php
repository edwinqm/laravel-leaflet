@extends('layouts.app')

@section('title', 'Leaflet-PruneControl')

@include('_partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{!! Html::script('leaflet/js/PruneCluster.js') !!}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            {!! Breadcrumbs::render('prune-cluster') !!}

                <div class="panel panel-default">

                    <div class="panel-body">

                        <div id="map"></div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>

        var lat = 59.911111, lng = 10.752778;
        var map = L.map('map', {
            attributionControl: false,
            zoomControl: false
        });
        map.setView(new L.LatLng(lat, lng), 17);

        var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            detectRetina: true,
            maxNativeZoom: 17
        });
        tileLayer.addTo(map);

        var leafletView = new PruneClusterForLeaflet(60);

        var marker = new PruneCluster.Marker(lat, lng, {num: "special"});
        leafletView.RegisterMarker(marker);

        var markers = [], size = 10;
        //
        for (var i = 0; i < size; ++i) {
            var m = new PruneCluster.Marker(lat + i * 0.001, lng + i * 0.001, {num: i});
            markers.push(m);
            leafletView.RegisterMarker(m);
        }

        //
        leafletView.PrepareLeafletMarker = function (marker, data) {
            var t = "Num: " + data.num;
            if (marker.getPopup())
                marker.setPopupContent(t);
            else
                marker.bindPopup(t);

            console.log(data);
        }

        window.setInterval(function () {
            marker.position.lng += 0.0001;
            //
            for(var i = 0; i < size; ++i){
                markers[i].position.lng += 0.00001;
            }

            leafletView.ProcessView();
        }, 1000);

        map.addLayer(leafletView);

    </script>
@endsection

