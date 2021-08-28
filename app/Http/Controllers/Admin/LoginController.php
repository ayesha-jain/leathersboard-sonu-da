<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;
use Mail;
use Crypt;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function signIn() {
    	return view('admin.auth.login');
    }

    /* function for admin authentication */
    public function adminAuthentication(Request $request) {
     
    	$input = $request->input();
		/* set validation rules here */
		$validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
		/* if the validator fails, redirect back to the form */
        if ($validator->fails()) {
    		return back()->withInput($input)->withErrors($validator);
        }
        else {
	    	$user=User::where('email',$input['email'])->first();
            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
                $auth_user=Auth::User();
                return redirect('admin/dashboard');
            }
            else{
                \Session::flash('message', 'Incorrect Password');
                return back()->withInput($input);
            }
        }
    }
    public function forgotpassword() {
        return view('admin.auth.forgotpass');
    }
    public function forgotpasswordCheck(Request $request) {
        $input = $request->input();
		/* set validation rules here */
		$validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
		/* if the validator fails, redirect back to the form */
        if ($validator->fails()) {
    		return back()->withInput($input)->withErrors($validator);
        }
        else {
	    	$user=User::where('email',$input['email'])->first();
            if($user->email_verified=='1'){
                if($user->is_active!='0'){
                //    if($user->user_type=='A'){
                    $roles = $user->getRoleNames()->toArray();
                    $userPermissions = $user->getAllPermissions();
                    $arrayPermission=[];
                    foreach($userPermissions as $userPermission){
                        $arrayPermission[]=$userPermission->name;
                    }
                    //dd($arrayPermission);
                    if(in_array('Login', $arrayPermission)){
                        $data = [
                            'name' => $user->name,
                            'id' => $user->id,
                            'email' => $user->email,
                            'type' =>"1"
                        ];
                        Mail::send('emailTemplates.reserpass', ['data' => $data], function ($message) use ($data) {
                            $message->to($data['email'], $data['name'])->subject('Reset Your password');
                        }); 
                        \Session::flash('successmessage', 'We have sent you the link in your inbox to reset your password');
                        return back()->withInput($input);

                    }
                    else{
                        \Session::flash('message', 'You Do not have admin access');
                        return back()->withInput($input);
                    }
                    //if (Gate::allows('can_login', $user)) {

                //     }else{
                //         \Session::flash('message', 'Invalid user');
                //         return back()->withInput($input);
                // }
                }else{
            }
            }
	    	else {
	    		\Session::flash('message', 'These credentials do not match our records.');
	    		return back()->withInput($input);
	    	}
        }
    }
    public function resetpassword($userid = null) {
        $payload = json_decode(base64_decode($userid), true);
        if($payload!=null){
            $getUserId = Crypt::decrypt($userid);
            $getUser = User::where('id',$getUserId)->first();
            if(isset($getUser)){
                return view('admin.auth.resetpass',compact('getUser')); 
            }else{
                abort('404',"page not found");
            }    
        }else{
            abort('404',"page not found");
        } 
    }
    public function resetpasswordcheck(Request $request) {
        $input = $request->input();
        if(isset($input['id'])){
            $user = User::where('id',$input['id'])->first();
            if(isset($user)){
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|min:8|same:password',  
                ]);
                if ($validator->fails()) {
                    return back()->withInput($input)->withErrors($validator);
                } else{
                    $user->password = Hash::make($input['password']);
                    $user->save();
                    return redirect()->route('login')->withSuccess("Password reset successfully");
                }
            }else{
                \Session::flash('message', 'Invalid user');
                    return back()->withInput($input); 
            }
        }else{
            \Session::flash('message', 'Invalid user');
                return back()->withInput($input);  
        }
    }
    public function changePassword() {
        return view('admin.auth.changepass');
    }
    public function changePasswordCheck(Request $request) {
        $input = $request->input();
        $cp=Hash::check($input['old_password'], Auth::User()->password);
        if ($cp>0) 
        {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|min:8|same:password',      
            ]);
            if ($validator->fails()) {
                return back()->withInput($input)->withErrors($validator);
            }   
        }
        else 
        {
            return back()->withErrors([
                'message' => 'Your Current password is incorrect.'
            ]);
        }
        $user=Auth::User();
        $user->password = Hash::make($input['password']);
        $user->save();
        return redirect()->route('admin_dashboard');
    }
    public function myprofileEdit() {
        $auth_user = Auth::user();
        $profile = User::where(['id'=>$auth_user->id])->first();
        return view('admin.auth.profile',['profile'=>$profile]);
    }
    public function myprofileSave(Request $request) {
        $auth_user = Auth::user();
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>'required|email|max:255',
            'phone' => 'numeric|min:10',
            'profile_picture' => 'mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return back()->withInput($input)->withErrors($validator);
        }else{
            $user = User::where(['id'=>$auth_user->id])->first();
            if ($request->hasFile('profile_picture')) {
                $newFileName =  '';
                if ($user['profile_picture'] == null) {
                    $destinationPath = public_path('web_assets/images/profilePicture/');
                    $newFileName = 'pp' . mt_rand(10, 100) . time() . '.' . $request['profile_picture']->getClientOriginalName();
                    $request['profile_picture']->move($destinationPath, $newFileName);
                    $user->update([
                    'profile_picture' => $newFileName,
                    ]);
                } else {
                    $previousFile = $user['profile_picture'];
                    $destinationPath = public_path('web_assets/images/profilePicture/');
                    $newFileName = 'pp' . mt_rand(10, 100) . time() . '.' . $request['profile_picture']->getClientOriginalName();
                    $request['profile_picture']->move($destinationPath, $newFileName);
                    $user->update([
                    'profile_picture' => $newFileName,
                    ]);
                    unlink(public_path('web_assets/images/profilePicture/') . $previousFile);
                }
            }
            $request_data= $input;
            $request_data['name']=$input['first_name']. " " .$input['last_name'];
            $user->fill($request_data)->save();
            return redirect()->route('admin_profile_edit')->withSuccess("Your Profile Updated Successfully");
        }
    }
}
