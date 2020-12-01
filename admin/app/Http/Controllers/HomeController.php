<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModel;
use App\CourseModel;
use App\ProjectsModel;
use App\ReviewModel;
use App\ServiceModel;
use App\VisitorModel;

class HomeController extends Controller
{
    function HomeIndex(){
       $TotalContact =ContactModel::count();
       $TotalCourse=CourseModel::count();
       $TotalProject=ProjectsModel::count();
       $TotalReview=ReviewModel::count();
       $TotalService=ServiceModel::count();
       $TotalVisitor=VisitorModel::count();

        return view('Home',[
            'TotalContact'=>$TotalContact,
            'TotalCourse'=>$TotalCourse,
            'TotalProject'=>$TotalProject,
            'TotalReview'=>$TotalReview,
            'TotalService'=>$TotalService,
            'TotalVisitor'=>$TotalVisitor
        ]);
    }
}
