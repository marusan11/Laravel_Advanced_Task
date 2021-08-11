<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    //store関数は、ユーザが他のユーザをフォローする処理を担当。
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }

    //destroy関数は、ユーザがしているフォローを外す処理を担う。
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
