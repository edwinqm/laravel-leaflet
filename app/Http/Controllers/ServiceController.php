<?php

namespace App\Http\Controllers;

use App\DataTables\PostsDataTable;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getUsersDataTables(UsersDataTable $dataTable)
    {
        return $dataTable->render('datatable.service.two-datatables');
    }

    public function getPostsDataTables(PostsDataTable $postsDataTable)
    {
        return $postsDataTable->render('datatable.service.two-datatables');
    }

}
