<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';
    protected $guarded = ['id'];

    function tag(){
        return $this->belongsTo('App\Models\Tag', 'tag_id', 'id');
    }

    function files(){
        return $this->hasMany('App\Models\File', 'ad_id', 'id');
    }

    function attributes(){
        return $this->hasMany('App\Models\Attribute', 'ad_id', 'id');
    }

}
