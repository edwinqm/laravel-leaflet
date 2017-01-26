<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeafletController extends Controller
{

    public function index()
    {
        return view('leaflet.index');
    }

    public function basic()
    {
        
        return view('leaflet.basic');
    }


    public function pruneCategories()
    {

        return view('leaflet.prune-categories');
    }

    public function pruneCluster()
    {

        return view('leaflet.prune-cluster');
    }

    public function pruneControl()
    {

        return view('leaflet.prune-control');
    }
}
