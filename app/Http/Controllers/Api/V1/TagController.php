<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Base\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Add(Request $request){
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();
        return response()->AloResponse($tag, 'success', Lang::get('messages.TagAdded'));
    }
    public function Delete($id){
        $tag = Tag::find($id);
        if (!empty($tag)){
            $tag->delete();
            return response()->AloResponse(null, 'success', Lang::get('messages.TagDeleted'));
        }
        return response()->AloResponse(null, 'fail', Lang::get('messages.InvalidData'));
    }



}