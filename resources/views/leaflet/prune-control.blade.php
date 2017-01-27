@extends('layouts.app')

@section('title', 'Leaflet-PruneControl')

@include('partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{!! Html::script('leaflet/js/PruneCluster.js') !!}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            {!! Breadcrumbs::render('prune-control') !!}

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

        var lat = -17.78424, lng = -63.18087;

        var map = L.map("map", {
            attributionControl: false,
            zoomControl: false
        }).setView(new L.LatLng(lat, lng), 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            detectRetina: true,
            maxNativeZoom: 17
        }).addTo(map);

        var leafletView1 = new PruneClusterForLeaflet();
        var leafletView2 = new PruneClusterForLeaflet();

        var size = 100;
        var markers = [];
        for (var i = 0; i < size; ++i) {
            var marker = new PruneCluster.Marker(
                    lat + (Math.random() - 0.5) * Math.random() * 0.001 * size,
                    lng + (Math.random() - 0.5) * Math.random() * 0.002 * size,
                    {title:i}
            );

            markers.push(marker);
            if (marker.position.lat > lat) {
                leafletView1.RegisterMarker(marker);
            } else {
                leafletView2.RegisterMarker(marker);
            }
        }

        window.setInterval(function () {
            for (i = 0; i < size / 2; ++i) {
                var coef = i < size / 8 ? 10 : 1;
                var ll = markers[i].position;
                ll.lat += (Math.random() - 0.5) * 0.001 * coef;
                ll.lng += (Math.random() - 0.5) * 0.002 * coef;
            }

            leafletView1.ProcessView();
            leafletView2.ProcessView();
        }, 1000);

        var overlays = {
            "Group A": leafletView1,
            "Group B": leafletView2
        };

        console.log(overlays);

        leafletView1.PrepareLeafletMarker = function (marker, data) {
            if(marker.getPopup()){
                marker.setPopupContent('<b>Title: '+data.title+'</b><br>Group: A<br>'+marker.getLatLng().toString())
            }else{
                marker.bindPopup('<b>Title: '+data.title+'</b><br>Group: A<br>'+marker.getLatLng().toString())
            }
        }
        leafletView2.PrepareLeafletMarker = function (marker, data) {
            if(marker.getPopup()){
                marker.setPopupContent('<b>Title: '+data.title+'</b><br>Group: B<br>'+marker.getLatLng().toString())
            }else{
                marker.bindPopup('<b>Title: '+data.title+'</b><br>Group: B<br>'+marker.getLatLng().toString())
            }
        }

//        map.addLayer(leafletView1);
        map.addLayer(leafletView2);

        L.control.layers(null, overlays).addTo(map);

    </script>
@endsection

