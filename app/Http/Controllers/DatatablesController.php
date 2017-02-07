<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function example1()
    {
        if (request()->ajax()) {
            return Datatables::of(User::query())->make(true);
        }

        return view('datatable.example1');
    }

    public function responsive()
    {
        if (request()->ajax()) {
            
            return Datatables::of(User::query())->make(true);
        }

        return view('datatable.responsive');
    }
}
