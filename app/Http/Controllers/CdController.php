<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CdController extends Controller
{
    public function index(){
        return view('admin.CD.index');
    }
}
