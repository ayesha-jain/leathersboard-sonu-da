<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsForm extends Model
{
    protected $table = 'contactusforms';
    protected $fillable=['email','name','message']; 
}
