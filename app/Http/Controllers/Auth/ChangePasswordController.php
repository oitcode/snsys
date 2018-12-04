<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Validator;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show change password page.
     *
     * @return Response
     */
    public function olChangePassword()
    {
        return view('auth.passwords.olreset');
    }

    /**
     * Rules to change password.
     *
     * @param array cpData
     *
     * return Validator
     */
    public function changePasswordValidator(array $cpData)
    {
      $messages = [
        'curpass.required' => 'Please enter current password',
        'newpass.required' => 'Please enter new password',
        'confnewpass.required' => 'Please confirm new password',
      ];
    
      $validator = Validator::make($cpData, [
        'curpass' => 'required',
        'newpass' => 'required|between:10,25',
        'confnewpass' => 'required|same:newpass',
      ], $messages);
    
      return $validator;
    }  

    /**
     * Process password page request.
     *
     * @return Response
     */
    public function olChangePasswordProcess(Request $request)
    {
	$requestData = $request->all();
	$validator = $this->changePasswordValidator($requestData);

	if ($validator->fails()) {
	    /* Todo: Redirect back with error message */
	    die("Password change validation failed!");
	} else {
	    $dbCurPass = Auth::User()->password;
	    if (Hash::check($requestData['curpass'], $dbCurPass)) {
	        $curUserId = Auth::User()->id;
	        $curUser = \App\User::find($curUserId);
		$curUser->password = Hash::make($requestData['newpass']);
		$curUser->save();
		$request->session()->flash('status', 'Success: Password changed');
	    } else {
	        /* Todo: Redirect back with error message */
	        die("Wrong current password");
	    }
	}

        return redirect('/');
    }
}
