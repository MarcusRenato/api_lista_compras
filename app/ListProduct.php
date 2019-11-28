<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListProduct extends Model
{
    protected $fillable = ['id_list', 'name', 'description', 'price', 'image'];

    public function Listbuys()
    {
        //return $this->hasOne(Listbuy::class, 'id', 'id_list');
    }
}
