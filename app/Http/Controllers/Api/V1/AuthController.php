<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Base\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;


class AuthController extends Controller
{
    public function Login(Request $request){
        $this->validate($request, [
            'Email' => 'required',
            'Password' => 'required'
        ]);
        $user = User::where('Email', $request->Email)->first();
        if (!$user){
            return response()->AloResponse(null, 'fail', Lang::get('messages.LoginFailed'));
        }
        if(md5($request->Password) === $user->Password){
            $apikey = self::CreateApiToken($request->Email);
            return response()->AloResponse('Api Token => '.$apikey, 'success', Lang::get('messages.LoginSuccess'));
        }else{
            return response()->AloResponse(null, 'fail', Lang::get('messages.LoginFailed'));
        }

    }




    public function login2(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'Email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['Email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function Register(Request $request){

        $User = User::where('Email',$request->Email)->orwhere('Username',$request->Username)->first();
        if (!empty($User)){
            return response()->AloResponse(null, 'fail', Lang::get('messages.DuplicateEmail'));
        }
        $User = User::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Username' => $request->Username,
            'password' => app('hash')->make($request->Password)
        ]);
        return response()->AloResponse($User, 'success', Lang::get('messages.RegisterSuccess'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public static function CreateApiToken($Email)
    {
        $ApiToken = base64_encode(str_random(60));
        User::where('Email', $Email)->update(['api_token' => "$ApiToken"]);
        return $ApiToken;
    }

}