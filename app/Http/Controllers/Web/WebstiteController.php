<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\SubscriberEmail;
use App\Models\ContactUsForm;
use Illuminate\Support\Facades\Validator;

class WebstiteController extends Controller
{
    public function homepage() {
        $categories =Category::get();
        return view('web.homepage',compact('categories'));
    }
    public function category($categoryid) {
        //dd($categoryid);
        $category =Category::where('id',$categoryid)->first();
        if(isset($category)){
            $categories =Category::get();
            $products =Product::where('category_id',$categoryid)->paginate(10);
            return view('web.category',compact('products','categories','categoryid'));
        }
        else{
            abort('404',"page not found");
        }
    }
    public function product($categoryid,$productid) {
        $product =Product::where('id',$productid)->first();
        return view('web.product',compact('product'));
    }
    public function about() {
        return view('web.about');
    }
    public function contact() {
        return view('web.contact');
    }
    public function contactformsubmit(Request $request) {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }
        else
        {
            $form = new ContactUsForm();
            $form->name = $input['name'];
            $form->email = $input['email'];
            $form->message = $input['message'];
            $form->save();
            return redirect()->back()->withSuccess("Thank you! We will reach you shortly.");        
        }
    }
    public function subscriptionemailformsubmit(Request $request) {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'subscriberemail' => 'required|email|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }
        else
        {
            $form = new SubscriberEmail();
            $form->email = $input['subscriberemail'];
            $form->save();
            return redirect()->back()->withSuccess("Thank you! We will reach you shortly.");
        }
    }

}
