<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardConttroller extends Controller
{
    public function index(){
    	return view('kasie.dashboard.index');
    }
}
