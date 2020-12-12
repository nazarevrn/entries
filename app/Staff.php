<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['id', 'name', 'code', 'phone'];

    public function entries()
    {
        $this->hasMany('App\Entries');
    }
}
