<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listbuy extends Model
{
    protected $fillable = ['name', 'category'];

    public function listProduct()
    {
        return $this->hasMany(ListProduct::class, 'id_list', 'id');
    }
}
