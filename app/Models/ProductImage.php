<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable=['product_id','type','status','image','mimetype','org_name']; 
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
