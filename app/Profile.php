<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'address', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
