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

        // center of santa cruz
        var lat = -17.78424, lng = -63.18087;

        // create a map of the center of Santa Cruz
        var map = L.map('map', {
            attributionControl: false,
            zoomControl: false
        });
        map.setView(new L.LatLng(lat, lng), 14);

        // create a tile layer to add to our map
        var tileLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            detectRetina: true,
//            maxNativeZoom: 18,
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        // set and display tile on map
        tileLayer.addTo(map);

        // create a PruneCluster For Leaflet that will contain out markers
        //        var leafletView = new PruneClusterForLeaflet();
        var leafletViews = [];

        // array of markers
        var markers = [];
        var markersWay = [];

        // objects
        var objects = {!! json_encode($objects) !!};

        for (var i = 0; i < objects.length; ++i) {

            var marker = new PruneCluster.Marker(
                    objects[i].lat,
                    objects[i].lng,
                    {
                        imei: objects[i].imei
                    }
            );
            markers.push(marker);

            markersWay.push({
                imei: objects[i].imei,
                latlng: [
                    [objects[i].lat, objects[i].lng]
                ]
            });

            var leafletView = new PruneClusterForLeaflet();
            leafletView.RegisterMarker(marker);

            leafletViews.push(leafletView);

        }

        // windows event for autoload with ajax call
        window.setInterval(function () {

            for (var i = 0, l = markers.length; i < l; ++i) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/maps/ajax",
                    method: "post",
                    dataType: 'json',
                    data: {imei: markers[i].data.imei, lat: markers[i].position.lat, lng: marker.position.lng},
                    async: false,
                    cache: false,
                    success: function (data) {
                        console.log(data.imei + '||' + data.lat + '|' + data.lng);
                        console.log(i);
                        markers[i].position.lat = data.lat;
                        markers[i].position.lng = data.lng;

                        markersWay[i].latlng.push([data.lat, data.lng]);

                        L.polyline(markersWay[i].latlng, {
                            color: 'red'
                        }).addTo(map);

                    },
                });

            }

            // refresh the map view


        }, 5000);

        // array of overlays
        var overlays = {};

        for (var i = 0; i < leafletViews.length; ++i) {

            overlays[markers[i].data.imei] = leafletViews[i];

            leafletViews[i].PrepareLeafletMarker = function (marker, data) {
                if (marker.getPopup()) {
                    marker.setPopupContent('<b>Title: ' + data.imei + '</b><br>' + marker.getLatLng().toString())
                }
                else {
                    marker.bindPopup('<b>Title: ' + data.imei + '</b><br>' + marker.getLatLng().toString())
                }
            }

            map.addLayer(leafletViews[i]);
        }

        L.control.layers(null, overlays).addTo(map);

    </script>
@stop