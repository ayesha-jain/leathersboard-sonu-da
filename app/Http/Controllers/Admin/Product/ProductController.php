<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $data=Product::get();
        return view('admin.product.list',compact('data'));
    }
    public function create()
    {
        $categories =Category::get();
        return view('admin.product.add',compact('categories'));
    }
    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()){
            return back()->withInput($input)->withErrors($validator);
        }
        else
        {
            $request_data = $input;
            $data=null;
            $msg = 'Product Edited Successfully';
            //dd($request_data);
            if(!empty($request_data['id']) && $request_data['id'] != ''){
                $data =Product::where('id',$request_data['id'])->first();
                $data->name = $input['name'];
                $data->category_id = $input['category_id'];
                $data->description = $input['description'];
                $data->code = $input['code'];
                $data->save();
            }
            if(!$data){
                $msg = 'Product Added Successfully';
                $data = new Product;
                $data->name = $input['name'];
                $data->category_id = $input['category_id'];
                $data->description = $input['description'];
                $data->code = $input['code'];
                $data->save();
            }
            $imageRules = array(
                'image' => 'mimes:jpeg,jpg,png'
            );
           
            if(isset($request_data['delete_images']) && count($request_data['delete_images'])>0){
                for($i=0;$i<count($request_data['delete_images']);$i++){
                    $productimage = ProductImage::where('id',$request_data['delete_images'][$i])->first();
                    unlink(public_path('assets/images/product/') . $productimage['image']);
                    $productimage->delete();
                }
            }
            if($request->hasFile('files')){
                foreach($request->file('files') as $image){
                    $image = array('image' => $image);
                    $imageValidator = Validator::make($image, $imageRules);
                    if ($imageValidator->fails()) {
                        $messages = $imageValidator->messages();
                        return back()->withErrors($messages);
                    }
                }
                foreach($request->file('files') as $key => $image){
                    $mime= $image->getMimeType();
                    $fileName = 'prod'.$key.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/images/product/');
                    $image->move($destinationPath, $fileName);
                    ProductImage::create([
                    'product_id' => $data->id,
                    'org_name' => $image->getClientOriginalName(),
                    'mimetype' => $mime,
                    'image' => $fileName,
                    ]);
                }
            }
            return redirect()->route('product.index')->withSuccess($msg);
        }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories =Category::get();
        $data=Product::where('id',$id)->first();
        if(isset($data)){
            //dd($data->productimages);
            return view('admin.product.add',compact('data','categories'));
        }
        else{
            abort('404','page not found');
        }
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function delete($id=null){
        $abstractProduct = Product::where('id',$id)->first();
        $abstractProduct->delete();
        return redirect()->route('product.index')->withSuccess("Product Deleted Successfully");
    }

}
