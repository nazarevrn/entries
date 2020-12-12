<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    protected $fillable = ['staff_id', 'timestamp', 'pass_direction'];

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

}
