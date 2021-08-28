<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data=Category::get();
        return view('admin.category.list',compact('data'));
    }
    public function create()
    {
        return view('admin.category.add');
    }
    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }
        else
        {
            $request_data = $input;
            $data=null;
            $msg = 'Category Edited Successfully';
            //dd($request_data['id']);
            if(!empty($request_data['id']) && $request_data['id'] != '')
            {
                $data =Category::where('id',$request_data['id'])->first();
            }
            if(!$data)
            {
                $msg = 'Category Added Successfully';
                $data = new Category;
            }
            if ($request->hasFile('image')) {
                $newFileName =  '';
                $orginalFileName = $request['image']->getClientOriginalName();
                $mimeType = $request['image']->getClientMimeType();
                if ($data['image'] == null) {
                    $destinationPath = public_path('assets/images/category/');
                    $newFileName = 'cat' . mt_rand(10, 100) . time() . '.' . $request['image']->getClientOriginalName();
                    $request['image']->move($destinationPath, $newFileName);
                } else {
                    $previousFile = $data['image'];
                    $destinationPath = public_path('assets/images/category/');
                    $newFileName = 'cat' . mt_rand(10, 100) . time() . '.' . $request['image']->getClientOriginalName();
                    $request['image']->move($destinationPath, $newFileName);
                    unlink(public_path('assets/images/category/') . $previousFile);
                }
                $request_data['image']=$newFileName;
            }
            unset($request_data['id']);
            $data->fill($request_data)->save();
            return redirect()->route('category.index')->withSuccess($msg);
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            return view('admin.category.add',compact('data'));
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
        $abstractcategory = Category::where('id',$id)->first();
        $abstractcategory->delete();
        return redirect()->route('category.index')->withSuccess("Category Deleted Successfully");
    }
}
