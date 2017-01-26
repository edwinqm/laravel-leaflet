@extends('layouts.app')

@section('title', 'Leaflet-PruneControl')

@include('partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{{--{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}--}}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{{--{!! Html::script('leaflet/js/PruneCluster.js') !!}--}}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            {!! Breadcrumbs::render('basic') !!}

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

        var clat = -17.78424, clng = -63.18087;
        var wlat = -17.770856, wlng = -63.192141;
        var hlat = -17.810681, hlng = -63.122576;
        var cotoca = [-17.75326, -62.99698];
        var viruviru = [-17.64991, -63.13843];

        // Initialize the map on the "map" div with a given center and zoom
        var map = L.map('map', {
            center: [clat, clng],
            zoom: 14
        });

        // OpenStreetMaps
        var urlOms = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
        var attributionOms = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors';
        // Googlemaps
        var urlGmps = 'http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}';
        var attributionGmps = '&copy; <a href="#">Googlemaps</a> contributors';

        var tileLayer = L.tileLayer(urlGmps, {
            attribution: attributionGmps,
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        tileLayer.addTo(map);

        // Adding a marker
        var marker = L.marker([wlat, wlng]);

        // Setting a Popup
        marker.bindPopup("<b>Info</b><br>Hi, I'm a Popup");
        // Adding and open Popup
        marker.addTo(map).openPopup();

        // Create a red Polyline from an array of LatLng points
        var latlngs = [
            [
                [45.51, -122.68],
                [37.77, -122.43],
                [34.04, -118.2]
            ],
            [
                [40.78, -73.91],
                [41.83, -87.62],
                [32.76, -96.72]
            ],
        ];
        var latlngs2 = [
            [
                [wlat, wlng],
                [clat, clng],
                [hlat, hlng]
            ]
        ];

        var polyline1 = L.polyline(latlngs, {
            color: 'red'
        });
        var polyline2 = L.polyline(latlngs2, {
            color: 'blue'
        });
        polyline1.addTo(map);
        polyline2.addTo(map);

        // Zoom the map to the polyline
        map.fitBounds(polyline2.getBounds());

        // Adding a point
        var oldLatLngs = polyline2.getLatLngs();
        oldLatLngs.push([cotoca, viruviru]);

        polyline2.setLatLngs(oldLatLngs);

        //    var center = polyline.getCenter();

        //    console.log(center);
        //    L.marker(center).addTo(map);

        var polygon = L.polygon(latlngs2, {color: 'green'});
        polygon.addTo(map);
        polygon.bindPopup("Poligon Popup");

        map.fitBounds(polygon.getBounds());

    </script>
@endsection

