<?php

namespace App\Http\Controllers;

use App\GSObject;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {

        $object = DB::table('gs_objects')->where('imei', '=', 'RIDD0172431')->first();
        $object2 = DB::table('gs_objects')->where('imei', '=', 'RIDD0172248')->first();

        return view('map.index', [
            'object' => $object,
            'object2' => $object2,
        ]);
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {

            $imeis = ['RIDD0172431', 'RIDD0172248', 'RIDD0172421'];

            $imei = $request->get('imei');

            $obj = DB::table('gs_objects')->where('imei', '=', $imei)->first();

            $lat = $request->get('lat');
            $lng = $request->get('lng');

//            switch ($imei) {
//                case $imeis[0]:
//                    $obj->lat = $lat + (rand(0, 1) - rand(0, 1) + rand(0, 1)) * 0.001;
//                    $obj->lng = $lng + (rand(0, 1) - rand(0, 1) + rand(0, 1)) * 0.001;
//                    break;
//                case $imeis[1]:
//                    $obj->lat = $lat + (rand(0, 1) + rand(0, 1) - rand(0, 1)) * 0.01;
//                    $obj->lng = $lng + (rand(0, 1) + rand(0, 1) - rand(0, 1)) * 0.01;
//                    break;
//                case $imeis[2]:
//                    $obj->lat = $lat + (rand(0, 1) - rand(0, 1) - rand(0, 1)) * 0.01;
//                    $obj->lng = $lng + (rand(0, 1) - rand(0, 1) - rand(0, 1)) * 0.01;
//                    break;
//            }
//            switch ($imei) {
//                case $imeis[0]:
//                    $lat += (rand(0, 1) - rand(0, 1) + rand(0, 1)) * 0.001;
//                    $lng += (rand(0, 1) - rand(0, 1) + rand(0, 1)) * 0.001;
//                    break;
//                case $imeis[1]:
//                    $lat += (rand(0, 1) + rand(0, 1) - rand(0, 1)) * 0.01;
//                    $lng += (rand(0, 1) + rand(0, 1) - rand(0, 1)) * 0.01;
//                    break;
//                case $imeis[2]:
//                    $lat += (rand(0, 1) - rand(0, 1) - rand(0, 1)) * 0.01;
//                    $lng += (rand(0, 1) - rand(0, 1) - rand(0, 1)) * 0.01;
//                    break;
//            }

            return response()->json([
                'imei' => $obj->imei,
                'lat' => $obj->lat,
                'lng' => $obj->lng,
            ]);
        }
    }

    public function tracking()
    {
//        $object = new GSObject('RIDD0172431', -17.78424, -63.18087);

        $imeis = ['RIDD0172431', 'RIDD0172248', 'RIDD0172421'];

        $object = DB::table('gs_objects')->where('imei', 'RIDD0172431')->get()->first();

        return view('map.tracking', [
            'object' => $object,
        ]);
    }

    public function tracking2()
    {
        $imeis = ['RIDD0172431', 'RIDD0172248', 'RIDD0172421'];

//        $object1 = new GSObject($imeis[0], -17.78424, -63.18087);
//        $object2 = new GSObject($imeis[1], -17.770856, -63.192141);
//        $object3 = new GSObject($imeis[2], -17.810681, -63.122576);

//        $objects = [get_object_vars($object1), get_object_vars($object2), get_object_vars($object3)];
//        $objects = [get_object_vars($object1)];

        $objects = DB::table('gs_objects')->select('imei', 'lat', 'lng')->whereIn('imei', $imeis)->get();
//        $objects = DB::table('gs_objects')->whereIn('imei', $imeis)->get();
        
        return view('map.tracking2', [
            'objects' => $objects,
        ]);
    }
}
