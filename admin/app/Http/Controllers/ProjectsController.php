<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsModel;

class ProjectsController extends Controller
{
    function ProjectsIndex(){
        return view('Projects');
    }

    function getProjectsData(){
        $result=json_encode(ProjectsModel::orderBy('id','desc')->get());
        return $result;
    }

    function getProjectsDetails(Request $req){
        $id=$req->input('id');
        $result=json_encode(ProjectsModel::where('id',$id)->get());
        return $result;
    }

    function ProjectsDelete(Request $req){

        $id=$req->input('id');
        $result=ProjectsModel::where('id',$id)->delete();
        
        if($result==true){
            return "1";
        }else{
            return "0";
        }
    }

    function ProjectsUpdate(Request $req){ 

        $id=$req->input('id');
        $course_name=$req->input('course_name');
        $course_des=$req->input('course_des');
        $course_fee=$req->input('course_fee');
        $course_totalenroll=$req->input('course_totalenroll');
        $course_totalclass=$req->input('course_totalclass');
        $course_link=$req->input('course_link');
        $course_img=$req->input('course_img');

        $result=ProjectsModel::where('id',$id)->update([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img
            ]);
        
        if($result==true){
            return "1";
        }else{
            return "0";
        }
    }

    function ProjectsAdd(Request $req){ 

        $course_name=$req->input('course_name');
        $course_des=$req->input('course_des');
        $course_fee=$req->input('course_fee');
        $course_totalenroll=$req->input('course_totalenroll');
        $course_totalclass=$req->input('course_totalclass');
        $course_link=$req->input('course_link');
        $course_img=$req->input('course_img');
        
        $result=ProjectsModel::insert([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img
            ]);
        
        if($result==true){
            return "1";
        }else{
            return "0";
        }
    }
}
