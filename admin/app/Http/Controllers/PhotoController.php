<?php

namespace App\Http\Controllers;

use App\PhotoModel;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    function PhotoIndex(){
        return view('Photo');
    }

    function PhotoUpload(Request $request){
        $photoPath=$request->file('photo')->store('public');
        $photoName=(explode('/',$photoPath))[1];
        $host=$_SERVER['HTTP_HOST'];
        $location=$host."/storage/".$photoName;
        $result = PhotoModel::insert(['location'=>$location]);

        if($result ==true){
            return 1;
        }else{
            return 0;
        }
    }
}
