<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModel;
class ContactController extends Controller
{


     function ContactIndex(){
		        return view('Contact');
		    }



function getContactData(){
			$result=json_decode(ContactModel::orderBy('id','desc')->get());
			return $result;
			}

function getContactDetails(Request $req){
			$id= $req->input('id');
			$result=json_decode(ContactModel::where('id','=',$id)->get());
			return $result;
			}


function ContactDelete(Request $req){
	$id= $req->input('id');
	$result=ContactModel::where('id','=',$id)->delete();

	if ($result==true) {
		return 1;
	}else{
		return 0;
	}

}




// function ContactUpdate(Request $req){
// 	$id= $req->input('id');
// 	$contact_name= $req->input('contact_name');
// 	$contact_mobile= $req->input('contact_mobile');
// 	$contact_email= $req->input('contact_email');
// 	$contact_msg= $req->input('contact_msg');

// 	$result=ContactModel::where('id','=',$id)->update(
// 		['contact_name'=>$contact_name,
// 		'contact_mobile'=>$contact_mobile,
// 		'contact_email'=>$contact_email,
// 		'contact_msg'=>$contact_msg]);

// 	if ($result==true) {
// 		return 1;
// 	}else{
// 		return 0;
// 	}

// }








function ContactAdd(Request $req){
	$id= $req->input('id');
	$contact_name= $req->input('contact_name');
	$contact_mobile= $req->input('contact_mobile');
	$contact_email= $req->input('contact_email');
	$contact_msg= $req->input('contact_msg');
	$result=ContactModel::insert(
		['contact_name'=>$contact_name,
		'contact_mobile'=>$contact_mobile,
		'contact_email'=>$contact_email,
		'contact_msg'=>$contact_msg,
	]);

	if ($result==true) {
		return 1;
	}else{
		return 0;
	}

}


}
