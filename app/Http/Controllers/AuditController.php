<?php

namespace App\Http\Controllers;

use App\Audit;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AuditController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(Audit::query())->make(true);
        }

        return view('audit.index');

    }

}
