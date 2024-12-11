<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NongkrongController extends Controller
{
     public function index(){
        return view('nongkrong.index');
    }

    public function create(){
        return view('nongkrong.create');
    }

    public function reply(){
        return view('nongkrong.reply');
    }
}
