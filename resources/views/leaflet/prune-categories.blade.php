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
            {!! Breadcrumbs::render('prune-categories') !!}

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

        // create a map of the center of Santa Cruz
        var map = L.map('map', {
            attributionControl: false,
            zoomControl: false
        });
        map.setView(new L.LatLng(lat, lng), 12);

        // create a tile layer to add to our map
        var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            detectRetina: true,
            maxNativeZoom: 18
        });
        tileLayer.addTo(map);

        // create a PruneCluster For Leaflet
        var leafletView = new PruneClusterForLeaflet();

        //----
        // Build Leaflet Cluster Icon for LeafletView
        leafletView.BuildLeafletClusterIcon = function (cluster) {
            var myIconMarker = new L.Icon.MyMarkerCluster();

            // if you have categories on your markers
            myIconMarker.stats = cluster.stats;
            // the number of markers inside the cluster
            myIconMarker.population = cluster.population;

            return myIconMarker;
        };

        // 10 colors
        var colors = ['red', 'blue', 'green', 'yellow', 'lime', 'orange', 'deepskyblue', 'gray', 'coral', 'fuchsia'],
                pi2 = Math.PI * 2;

        //=====================
        // extending Icon Class
        //=====================
        var x = 40, y = 40,
                r = x / 2,
                rx = x / 2, ry = y / 2;
        L.Icon.MyMarkerCluster = L.Icon.extend({
            // options
            options: {
                iconSize: new L.Point(x, y),
                className: 'prunecluster leaflet-markercluster-icon'
            },
            // create icon function
            createIcon: function () {
                // based on L.Icon.Canvas from shramov/leaflet-plugins (BSD licence)
                var canvas = document.createElement('canvas');
                this._setIconStyles(canvas, 'icon');

                var size = this.options.iconSize;
                canvas.width = size.x;
                canvas.height = size.y;

                // calling my draw function
                this.draw(canvas.getContext('2d'), size.x, size.y);

                return canvas;
            },
            // create shadow function
            createShadow: function () {
                return null;
            },
            // draw function
            draw: function (canvas, width, height) {
                var lol = 0;

                var start = 0;
                for (var i = 0; i < colors.length; ++i) {
                    // categories / markers (has 8/10)
                    var size = this.stats[i] / this.population;

                    // console log
//                console.log(this.population+'---');

                    // draw categories group border with colors
                    if (size > 0) {
                        canvas.beginPath();
                        canvas.moveTo(rx, ry);
                        canvas.fillStyle = colors[i];
                        var from = start + 0.05,
                                to = start + size * pi2;

                        if (to < from) {
                            from = start;
                        }
                        canvas.arc(rx, ry, r, from, to);
                        start = start + size * pi2;
                        canvas.lineTo(rx, ry);
                        canvas.fill();
                        canvas.closePath();
                    }
                }

                // draw categorie
                canvas.beginPath();
                canvas.fillStyle = 'white';
                canvas.arc(rx, ry, r - 5, 0, pi2);
                canvas.fill();
                canvas.closePath();

                canvas.fillStyle = '#555';
                canvas.textAlign = 'center';
                canvas.textBaseline = 'middle';
                canvas.font = 'bold 12px sans-serif';

                canvas.fillText(this.population, rx, ry, 50)
            }
        });

        var markerItems = 10;
        var markers = [];

        // create markers with random position
        for (var i = 0; i < markerItems; ++i) {
            var marker = new PruneCluster.Marker(
                    lat + (Math.random() - 0.5) * Math.random() * 0.011 * markerItems,
                    lng + (Math.random() - 0.5) * Math.random() * 0.022 * markerItems,
                    {title: i}
            );

            // This can be a string, but numbers are nice too
            marker.category = Math.floor(Math.random() * Math.random() * colors.length);
//        console.log(marker);

            // push marker in markers vector
            markers.push(marker);
            // register marker to view
            leafletView.RegisterMarker(marker);
        }

        // refresh view with an interval time
        window.setInterval(function () {
            for (var i = 0; i < markerItems; ++i) {
                var coef = i < markerItems / colors.length ? colors.length : 1;
                var ll = markers[i].position;
                ll.lat += (Math.random() - 0.5) * 0.0011 * coef;
                ll.lng += (Math.random() - 0.5) * 0.0022 * coef;
            }

            // refresh view for markers
            leafletView.ProcessView();
        }, 1500);

        // working with marker popus
        leafletView.PrepareLeafletMarker = function (marker, data, category) {
            if (marker.getPopup()) {
                marker.setPopupContent('<b>Name:' + data.title + "</b><hr><br>" + "Category:" + category + '<br>' + marker.getLatLng().toString());
            } else {
                marker.bindPopup('<b>Name:' + data.title + "</b><hr><br>" + "Category:" + category + '<br>' + marker.getLatLng().toString());
            }
        }

        map.addLayer(leafletView);

    </script>
@endsection

