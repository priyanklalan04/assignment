<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\User;

class UserdetailsController extends Controller
{
    public function testUserData(Request $request)
    {
        try {
            $users = new User;
            $userdata = $users->paginate(10);
            return view('userdata',compact('userdata'));
        } catch (\Exceptions $th) {
            log::error(__METHOD__.' '.$ex->getMessage());   
        }
    }
    public function ajaxUserData(Request $request)
    {
        try {
            if($request->ajax()){
                $users = new User;
                $sort_by = $request->get('sort_by');
                $sort_type = $request->get('sorttype');
                $search = $request->get('search');
                $search = str_replace(" ","%",$search);
                if(strlen($search) > 0 ){
                    $userdata = $users->where('name','like','%'.$search)->orderBy($sort_by,$sort_type)->paginate(10);
                }else{
                    $userdata = $users->orderBy($sort_by,$sort_type)->paginate(10);
                }
                return view('ajaxdata',compact('userdata'));
            }
        } catch (\Exceptions $th) {
            log::error(__METHOD__.' '.$ex->getMessage());   
        }
    }
}
