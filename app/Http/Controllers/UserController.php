<?php

namespace App\Http\Controllers;

use App\Geoguessr;
use Illuminate\Http\Request;


class UserController extends Controller
{
    //



    public function setName()
    {
        return view('user.setname');
    }




    public function saveName(Request $request)
    {

        $nickname = $request->input('nickname');

        $request->session()->put('nickname', $nickname);

        return redirect('/games');

    }

    public function apiuser(Request $request)
    {
        return $request->user();
    }


}
