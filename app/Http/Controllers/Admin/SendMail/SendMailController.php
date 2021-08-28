<?php

namespace App\Http\Controllers\Admin\SendMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEmail;
use App\Models\EmailTemplate;
use Mail;

class SendMailController extends Controller
{
    public function index() {
        $data=EmailTemplate::get();
        return view('admin.sendemail.list',compact('data'));
    }
    public function create() {
        return view('admin.sendemail.add');
    }
    public function store(Request $request) {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'mail_body' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }
        else
        {
            dd($input);
            $data = [
                'name' => $user['name'],
                'id' => $user['id'],
                'email' => $user['email'],
                'type' =>"0"
            ];
            Mail::send('emailTemplates.userverification', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('EBC abstract manager – please validate your account');
            });
        }
    }
    public function delete($id=null) {
        $emailtemplate = EmailTemplate::where('id',$id)->first();
        $useremail = UserEmail::where('email_template_id',$id)->first();
        $emailtemplate->delete();
        $useremail->delete();
        return redirect()->route('send-mail.index')->withSuccess("Email Template Deleted Successfully");
    }
}
