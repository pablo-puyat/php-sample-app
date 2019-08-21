<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['pivot'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
