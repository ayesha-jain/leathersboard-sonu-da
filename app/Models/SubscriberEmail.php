<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberEmail extends Model
{
    protected $table = 'subscriber_emails';
    protected $fillable=['email']; 
}
