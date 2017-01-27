@extends('layouts.app')

@section('title', 'Map-Tracking')

@include('partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{!! Html::script('leaflet/js/PruneCluster.js') !!}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">MAPS</div>
                    <div class="panel-body map-container">

                        <div id="map"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>

        var clat = -17.78424, clng = -63.18087;
        var wlat = -17.770856, wlng = -63.192141;
        var hlat = -17.810681, hlng = -63.122576;

        var cotoca = [-17.75326, -62.99698];
        var viruviru = [-17.64991, -63.13843];

        // center of santa cruz
        var lat = -17.78424, lng = -63.18087;

        // create a map of the center of Santa Cruz
        var map = L.map('map', {
            attributionControl: false,
            zoomControl: false
        });
        map.setView(new L.LatLng(lat, lng), 13);

        // create a tile layer to add to our map
        var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            detectRetina: true,
            maxNativeZoom: 18
        });

        // set and display tile on map
        tileLayer.addTo(map);

        // get initial data
        var imei = <?= json_encode($object->imei); ?>;
        var latitude = <?= json_encode($object->lat); ?>;
        var longitude = <?= json_encode($object->lng); ?>;

        // objects
        var marker = new PruneCluster.Marker(
                latitude,
                longitude,
                {
                    id: imei
                }
        );

        // create a polyline for out marker
        var markerWay = [
            [latitude, longitude]
        ];


        // create a PruneCluster For Leaflet that will contain out markers
        var leafletView = new PruneClusterForLeaflet();

        leafletView.RegisterMarker(marker);

        // working with markers events
        leafletView.PrepareLeafletMarker = function (marker, data) {
            // for popups
            if (marker.getPopup()) {
                marker.setPopupContent('<b>ID: ' + data.id + '</b><br>' + marker.getLatLng().toString());
            } else {
                marker.bindPopup('<b>ID: ' + data.id + '</b><br>' + marker.getLatLng().toString());
            }
        }

        // windows event for autoload with ajax call
        window.setInterval(function () {
            //

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/maps/ajax",
                method: "post",
                dataType: 'json',
                sync: false,
                cache: false,
                data: {imei: marker.data.id, lat: marker.position.lat, lng: marker.position.lng},
                success: function (data) {
                    console.log(data.imei + '||' + data.lat + '|' + data.lng);
                    marker.position.lat = data.lat;
                    marker.position.lng = data.lng;
                    markerWay.push([data.lat, data.lng]);
                },
            });
            L.polyline(markerWay, {
                color: 'lime'
            }).addTo(map);

            // refresh the map view
            leafletView.ProcessView();
//            markerPolyline.addTo(map);
//            map.fitBounds(markerPolyline.getBounds());

        }, 3000);

        // finally add out new layer on map
        map.addLayer(leafletView);

    </script>
@stop