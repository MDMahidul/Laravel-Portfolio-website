<?php

namespace App\Http\Controllers;

use App\PhotoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    function PhotoIndex(){
        return view('Photo');
    }

    function PhotoJSON(){
        return PhotoModel::take(4)->get();
    }

    function  PhotoDelete(Request $request){
        $OldPhotoURL=$request->input('OldPhotoURL');
        $OldPhotoID=$request->input('id');

        $OldPhotoURLArray=explode("/",$OldPhotoURL);
        $OldPhotoName=end($OldPhotoURLArray);

        $DeletePhotoFile=Storage::delete('public/'.$OldPhotoName);
        $DeleteRow=PhotoModel::where('id',$OldPhotoID)->delete();

        if($DeleteRow ==true){
            return 1;
        }else{
            return 0;
        }
    }

    function PhotoJSONByID(Request $request){
        $FirstID=$request->id;
        $LastID=$FirstID+4;
        return PhotoModel::where('id','>=',$FirstID)->where('id','<',$LastID)->get();
    }

    function PhotoUpload(Request $request){
        $photoPath=$request->file('photo')->store('public');
        $photoName=(explode('/',$photoPath))[1];
        $host=$_SERVER['HTTP_HOST'];
        $location="http://".$host."/storage/".$photoName;
        $result = PhotoModel::insert(['location'=>$location]);

        if($result ==true){
            return 1;
        }else{
            return 0;
        }
    }
}
