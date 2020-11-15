<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModel;
use App\CourseModel;
use App\ProjectModel;
use App\ReviewModel;
use App\ServicesModel;
use App\VisitorModel;

class HomeController extends Controller
{
     function HomeIndex(){
	$TotalContact= ContactModel::count();
	$TotalCourse= CourseModel::count();
	$TotalProject= ProjectModel::count();
	$TotalReview= ReviewModel::count();
	$TotalService= ServicesModel::count();
	$TotalVisitor= VisitorModel::count();

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
