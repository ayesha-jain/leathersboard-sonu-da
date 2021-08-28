<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallAbstract;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\AbstractCategory;
use App\Models\AddAbstract;
use App\Models\CallAbstractCategory;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;
use Mail;
use Auth;

class AbstractCallController extends Controller
{
    public function list(Request $request)
    {
        $auth_user=Auth::User();
        if (Gate::allows('call_for_abstract_list_check', $auth_user)) {
        $input = $request->input();
        $abstract = CallAbstract::orderBy('created_at','DESC')->paginate(15);
        $type=1;
        return view('admin.abstractCall.list',compact('abstract','type'));
        }
        else{
            abort("403","Permission Denied");
        }
    }
    public function create(Request $request){
        $auth_user=Auth::User();
        if (Gate::allows('call_for_abstract_add_check', $auth_user)) {
            $type="add";
            $abstract = '';
            $categories = AbstractCategory::where('status','1')->get();
            return view('admin.abstractCall.add',compact('type','categories'));
        }
        else{
            abort("403","Permission Denied");
        }

    }
    public function edit($id=null){
        $auth_user=Auth::User();
        if (Gate::allows('call_for_abstract_edit_check', $auth_user)) {
            $type="edit";
            $callAbstractCategories_val=[];
            $callAbstractCategories = CallAbstractCategory::where('callAbstractId',$id)->get();
            $categories = AbstractCategory::where('status','1')->get();
            $abstract = CallAbstract::where('id',$id)->first();
            foreach($callAbstractCategories as $key =>$value)
            {
                $callAbstractCategories_val[]=$value->categoryId;
            }
            return view('admin.abstractCall.add',compact('type','abstract','categories','callAbstractCategories_val'));
        }else{
            abort("403","Permission Denied");
        }
    }
    public function save(Request $request){
        $input = $request->all();
        //dd($input['category']);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'excerpt' =>'required',
            'text' =>'required',
            'start_date' =>'required|date',
            'end_date' =>'required|date|after:start_date',
            'reviewing_start_date' =>'required|date',
            'reviewing_end_date' =>'required|date|after:reviewing_start_date',
            'authorize_poster' =>'required',
            'category' =>'required',
            // 'image' => 'required|mimes:jpeg,png,jpg',
           //'status' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }
        
        $request_data = $input;
        // dd($request_data);
        if (isset($input['id'])) {
            $abstract = CallAbstract::where('id', $input['id'])->first();
            if (!empty($abstract)) {
                if ($request->hasFile('image')) {
                    $newFileName =  '';
                    $orginalFileName = $request['image']->getClientOriginalName();
                    $mimeType = $request['image']->getClientMimeType();

                    if ($abstract['image'] == null) {
                        $destinationPath = public_path('web_assets/images/call_abstract/');
                        $newFileName = 'abstract_call' . mt_rand(10, 100) . time() . '.' . $request['image']->getClientOriginalName();
                        $request['image']->move($destinationPath, $newFileName);
                        $abstract->update([
                        'image' => $newFileName,
                        'img_org_name' => $orginalFileName,
                        'img_mime_type' => $mimeType
                        ]);
                    } else {
                        $previousFile = $abstract['image'];
                        $destinationPath = public_path('web_assets/images/call_abstract/');
                        $newFileName = 'abstract_call' . mt_rand(10, 100) . time() . '.' . $request['image']->getClientOriginalName();
                        $request['image']->move($destinationPath, $newFileName);
                        $abstract->update([
                        'image' => $newFileName,
                        'img_org_name' => $orginalFileName,
                        'img_mime_type' => $mimeType
                        ]);
                        unlink(public_path('web_assets/images/call_abstract/') . $previousFile);
                    }
                }
                $callAbstractCategory = CallAbstractCategory::where('callAbstractId',$abstract->id)->delete();
                //dd($callAbstractCategory);
                if(isset($input['category']) && count($input['category'])>0){
                    for($id=0;$id<count($input['category']);$id++){
                        $callAbstractCategory = new CallAbstractCategory();
                        $callAbstractCategory->categoryId=$input['category'][$id];
                        $callAbstractCategory->callAbstractId=$abstract->id;
                        $callAbstractCategory->save();
                    }
                }
                $abstract->update([
                        'title' => $input['title'],
                        'description' => $input['excerpt'],
                        'text' => $input['text'],
                        'start_date' => date("Y-m-d", strtotime($input['start_date'])),
                        'end_date' =>  date("Y-m-d", strtotime($input['end_date'])),
                        'reviewing_start_date' => date("Y-m-d", strtotime($input['reviewing_start_date'])),
                        'reviewing_end_date' =>  date("Y-m-d", strtotime($input['reviewing_end_date'])),
                        // 'image' => $newFileName,
                        // 'img_org_name' => $orginalFileName,
                        // 'img_mime_type' => $mimeType,
                        'authorize_poster' => $input['authorize_poster']
                    ]);
                    Session::flash('success', 'Updated Successfully');
                    return redirect()->route('abstract_call_list');
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'image' => 'required|mimes:jpeg,png,jpg',
                ]);
                if ($validator->fails()) {
                    return back()->withInput($input)->withErrors($validator);
                }
                $newFileName =  '';
                $orginalFileName = '';
                $mimeType = '';

                if ($request->hasFile('image')) {
                    $orginalFileName = $request['image']->getClientOriginalName();
                    $mimeType = $request['image']->getClientMimeType();

                    $destinationPath = public_path('web_assets/images/call_abstract/');
                    $newFileName = 'abstract_call' . mt_rand(10, 100) . time() . '.' . $request['image']->getClientOriginalName();
                    $request['image']->move($destinationPath, $newFileName);
                }

                $abstract = new CallAbstract();
                $abstract->title = $input['title'];
                $abstract->text = $input['text'];
                $abstract->description = $input['excerpt'];
                $abstract->start_date = date("Y-m-d", strtotime($input['start_date']));
                $abstract->end_date = date("Y-m-d", strtotime($input['end_date']));
                $abstract->reviewing_start_date = date("Y-m-d", strtotime($input['reviewing_start_date']));
                $abstract->reviewing_end_date = date("Y-m-d", strtotime($input['reviewing_end_date']));
                $abstract->image = $newFileName;
                $abstract->img_org_name = $orginalFileName;
                $abstract->img_mime_type = $mimeType;
                $abstract->authorize_poster = $input['authorize_poster'];
                $abstract->save();
                if(isset($input['category']) && count($input['category'])>0){
                    for($id=0;$id<count($input['category']);$id++){
                        $callAbstractCategory = new CallAbstractCategory();
                        $callAbstractCategory->categoryId=$input['category'][$id];
                        $callAbstractCategory->callAbstractId=$abstract->id;
                        $callAbstractCategory->save();
                    }
                }
                Session::flash('success', 'Added Successfully');
                return redirect()->route('abstract_call_list');
        }
    }
    public function delete($id){
        $auth_user=Auth::User();
        if (Gate::allows('call_for_abstract_delete_check', $auth_user)) {
            $abstract = CallAbstract::where('id',$id)->first();
            $test=AddAbstract::where('callAbstractId',$abstract->id)->first();
            if(isset($test)){
                //$abstract = CallAbstract::where('id',$id)->first();
                //if(isset($abstract->allAbstract)){
                    echo json_encode(0);
                //}
            }
            //unlink(public_path('web_assets/images/call_abstract/') . $abstract['image']);
            else{
                // return redirect()->route('abstract_call_list')->withSuccess(" Deleted Successfully");
                $abstract->delete();
                 echo json_encode(1);
            }
            //return redirect()->route('abstract_call_list')->withSuccess(" Deleted Successfully");
        }else{
            abort("403","Permission Denied");
        }
    }
}
