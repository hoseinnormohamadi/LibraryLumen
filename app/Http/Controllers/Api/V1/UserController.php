<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Base\User;
use App\Models\Base\UserBooks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function All(){
        $Users = User::all();
        foreach ($Users as $user) {
            unset($user->Password);
            unset($user->api_token);
        }
        return response()->AloResponse($Users, 'success', Lang::get('messages.Users'));
    }
    public function MyInfo(){
        $UserInfo = Auth::user();
        unset($UserInfo->Password);
        return response()->AloResponse($UserInfo, 'success', Lang::get('messages.MyInfo'));
    }
    public function ChangePassword(Request $request){
        $this->validate($request, [
            'Password' => 'required',
            'NewPassword' => 'min:4|required_with:RepeatNewPassword|same:RepeatNewPassword',
            'RepeatNewPassword' => 'min:4'
        ]);
        if (md5($request->Password) === Auth::user()->Password){
            Auth::user()->Password = $request->NewPassword;
            AuthController::CreateApiToken(Auth::user()->Email);
            return response()->AloResponse(null, 'success', Lang::get('messages.PasswordUpdated'));
        }
    }
    public function MyBooks(){
        return response()->AloResponse(UserBooks::with('Details')->where('UserID',Auth::user()->ID)->get(), 'success', Lang::get('messages.MyBook'));
    }



}