<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'gs_object_data_ridd0172248';

    public $dt_server;
    public $dt_tracker;
    public $lat;
    public $lng;
    public $altitude;
    public $angle;
    public $speed;
    public $params;

}