<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function getDashboard(){
        return view('index');

        // return $this->success();
    }

    public function getNew(){
        // return view('index');

        return $this->success();
    }
}
