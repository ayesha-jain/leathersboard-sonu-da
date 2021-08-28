<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable=['category_id','name','description','code']; 
    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public function productimages(){
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }
}
