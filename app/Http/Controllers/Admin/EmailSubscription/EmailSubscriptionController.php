<?php

namespace App\Http\Controllers\Admin\EmailSubscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriberEmail;

class EmailSubscriptionController extends Controller
{
    public function list(){
        $data=SubscriberEmail::get();
        return view('admin.subscriptionemail.list',compact('data'));
    }
}
