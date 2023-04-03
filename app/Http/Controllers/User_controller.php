<?php

namespace App\Http\Controllers;

class User_controller extends Controller
{
    function update_page(){
     return view('update_user');
    }
    function create_page(){ 
     return view('create_page');
       }
    function list_page(){
     return view('edit_page');
       }
}



?>