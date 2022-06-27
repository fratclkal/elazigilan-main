<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = "attributes";
    protected $guarded = ['id'];

    function ad(){
        return $this->belongsTo('App\Models\Ad', 'ad_id', 'id');
    }

}
