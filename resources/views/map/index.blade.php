@extends('layouts.app')

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

        /*
         Note the difference in the "lyrs" parameter in the URL:
         Hybrid: s,h;
         Satellite: s;
         Streets: m;
         Terrain: p;
         */

        var imei = <?=json_encode($object->imei)?>;
        var latitude = '<?= json_encode($object->lat)?>';
        var longitude = '<?=json_encode($object->lng)?>';

        var imei2 = <?=json_encode($object2->imei)?>;
        var latitude2 = '<?= json_encode($object2->lat)?>';
        var longitude2 = '<?=json_encode($object2->lng)?>';

        //        console.log(imei + '||' + latitude + '|' + longitude);

        var wlat = -17.770856, wlng = -63.192141;
        var hlat = -17.810681, hlng = -63.122576;

        var map = L.map('map').setView([latitude, longitude], 18);

        var tileLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        tileLayer.addTo(map);

        L.control.scale().addTo(map);

        var marker = L.marker([latitude, longitude], {
            draggable: true
        });
        marker.addTo(map);
        marker.bindPopup("<b>IMEI:</b> " + imei + "<br><b>LATITUDE:</b> " + latitude + "<br><b>LONGITUDE:</b> " + longitude);
        marker.openPopup();

        var marker2 = L.marker([latitude2, longitude2], {
            draggable: true
        });
        marker2.addTo(map);
        marker2.bindPopup("<b>IMEI:</b> " + imei2 + "<br><b>LATITUDE:</b> " + latitude2 + "<br><b>LONGITUDE:</b> " + longitude2);
        //        marker2.openPopup();

        var i = 0;
        window.setInterval(function () {

////            var latLon = marker.getLatLng();
//            var p = marker.getPopup().getContent();
//
//            console.log(p.toString());
////            tileLayer.redraw();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/maps/ajax",
                method: "post",
                dataType: 'json',
                data: {imei: imei, imei2: imei2},
                success: function (data) {
                    marker.setLatLng([data.obj.lat, data.obj.lng]);
                    marker2.setLatLng([data.obj2.lat, data.obj2.lng]);
                    tileLayer.redraw();
                },

            }).done(function (data) {
                console.log("second success");
            }).fail(function (error) {
                console.log("error" + error);
            }).always(function () {
                console.log("finished");
            });


        }, 5000);


    </script>
@stop