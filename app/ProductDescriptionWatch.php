<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDescriptionWatch extends Model
{
    protected $table = 'cms_tmethod_data';

    public function method()
    {
    	return $this->hasOne(ProductMethodWatch::class, 'nid', 'nid_method')->orderBy('nid', 'asc');
    }
}
