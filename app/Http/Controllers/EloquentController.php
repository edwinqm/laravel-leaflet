<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class EloquentController extends Controller
{
    public function getRowDetails()
    {
        return view('datatable.eloquent.row-details');
    }

    public function postRowDetailsData(Request $request)
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);

        return Datatables::of($users)->make(true);
    }

    // FILTERS

    public function getPostColumnSearch()
    {
        return view('datatable.eloquent.post-column-search');
    }

    public function anyColumnSearchData(Request $request)
    {
        $users = User::select([
            DB::raw("CONCAT(users.id,'-',users.id) as user_id"),
            'name',
            'email',
            'created_at',
            'updated_at'
        ]);

        return Datatables::of($users)
            ->filterColumn('user_id', function ($query, $keyword) {
                $query->whereRaw("CONCAT(users.id,'-',users.id) like ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    // MASTER-DETAILS

    public function getMaster()
    {
        return view('datatable.eloquent.master-details');
    }

    public function getMasterData(Request $request)
    {
        $users = User::select([
            'users.id',
            'users.name',
            'users.email',
            DB::raw('count(posts.user_id) as count'),
            'users.created_at',
            'users.updated_at'
        ])
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->groupBy('posts.user_id');

        return Datatables::of($users)
            ->addColumn('details_url', function ($user) {
                return url('datatable/details-data');
            })
            ->addColumn('id', function ($user) {
                return $user->id;
            })
            ->make(true);
    }

    public function getDetailsData(Request $request)
    {
        $id = $request->get('id');

        $posts = User::find($id)->posts();

        return Datatables::of($posts)->make(true);
    }

    // COUNT ALIAS

    public function getCount()
    {
        return view('datatable.eloquent.count');
    }

    public function getCountData()
    {
        $users = User::select([
            'users.id',
            'users.name',
            'users.email',
            \DB::raw('count(posts.user_id) as count'),
            'users.created_at',
            'users.updated_at'
        ])->join('posts', 'posts.user_id', '=', 'users.id')
            ->groupBy('posts.user_id');

        return Datatables::of($users)->make(true);
    }

}
