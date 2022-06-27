<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = "tags";
    protected $guarded = ['id'];

    function ads(){
        return $this->hasMany('App\Models\Ad', 'tag_id', 'id');
    }

}
