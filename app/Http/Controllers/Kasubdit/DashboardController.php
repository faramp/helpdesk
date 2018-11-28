<?php

namespace App\Http\Controllers\Kasubdit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
    	return view('kasubdit.dashboard.index');
    }
}
