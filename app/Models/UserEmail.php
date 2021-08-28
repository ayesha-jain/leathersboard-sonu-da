<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $table = 'user_emails';
    protected $fillable=['email','email_template_id','status']; 
    public function category(){
        return $this->hasOne('App\Models\EmailTemplate','id','email_template_id');
    }
}
