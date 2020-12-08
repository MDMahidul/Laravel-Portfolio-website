<?php

namespace App\Http\Controllers;

use App\HomeSEOModel;
use App\ServiceModel;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use App\VisitorModel;
use App\CourseModel;
use App\ProjectsModel;
use App\ContactModel;
use App\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $ServicesData=json_decode(ServiceModel::all());
        $CoursesData=json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
        $ProjectsData=json_decode(ProjectsModel::orderBy('id','desc')->limit(6)->get());
        $ReviewData=json_decode(ReviewModel::all());

        //SEO config
        $HomeSeo=HomeSEOModel::all();
        $actual_link="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $HomeLink="http://$_SERVER[HTTP_HOST]";
        $HomeImage=$HomeLink."/".$HomeSeo[0]['page_img'];

        SEOMeta::setTitle($HomeSeo[0]['title']);
        SEOMeta::setDescription($HomeSeo[0]['description']);
        SEOMeta::setKeywords($HomeSeo[0]['keywords']);
        SEOMeta::setCanonical($actual_link);

        OpenGraph::addImage($HomeImage);
        OpenGraph::setDescription($HomeSeo[0]['description']);
        OpenGraph::setTitle($HomeSeo[0]['share_title']);
        OpenGraph::setUrl($actual_link);
        OpenGraph::setSiteName($HomeSeo[0]['share_title']);

        TwitterCard::setTitle($HomeSeo[0]['share_title']);

        JsonLd::setTitle($HomeSeo[0]['share_title']);
        JsonLd::setDescription($HomeSeo[0]['description']);
        JsonLd::addImage($HomeImage);

        $speech=HomeSEOModel::all()->random(1);

        return view('Home',[
            'ServicesData'=>$ServicesData,
            'CoursesData'=>$CoursesData,
            'ProjectsData'=>$ProjectsData,
            'ReviewData'=>$ReviewData,
            'speech'=>$speech
        ]);
    }

    function  ContactSend(Request $req){
        $contact_name = $req->input('contact_name');
        $contact_mobile = $req->input('contact_mobile');
        $contact_email = $req->input('contact_email');
        $contact_msg = $req->input('contact_msg');

        $result=ContactModel::insert([
            'contact_name'=>$contact_name,
            'contact_mobile'=>$contact_mobile,
            'contact_email'=>$contact_email,
            'contact_msg'=>$contact_msg,
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
