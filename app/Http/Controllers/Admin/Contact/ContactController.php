<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsForm;

class ContactController extends Controller
{
    public function list(){
        $data=ContactUsForm::get();
        return view('admin.contact.list',compact('data'));
    }
}
