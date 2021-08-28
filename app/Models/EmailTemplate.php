<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_templates';
    protected $fillable=['subject','mail_body','status']; 
    public function useremails(){
        return $this->hasMany('App\Models\UserEmail','email_template_id','id');
    }

}
