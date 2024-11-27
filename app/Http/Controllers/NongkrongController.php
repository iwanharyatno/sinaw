<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NongkrongController extends Controller
{
     public function index(){
        return view('nongkrong.index');
    }
}
