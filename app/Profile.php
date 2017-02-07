<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class Profile extends Model
{
    use Auditable;
    
    protected $fillable = [
        'address', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
