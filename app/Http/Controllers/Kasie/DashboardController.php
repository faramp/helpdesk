<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index(){
    	
    	$data['intruksi_saya_belum_selesai']=DB::table('task_item')->where([
									    ['assign_to', '=', session('id')],
									    ['status_id', '=', '4'],
									])->count();

    	$data['intruksi_saya_menunggu_penilaian']=DB::table('task_item')->where([
									    ['assign_to', '=', session('id')],
									    ['status_id', '=', '5'],
									])->count();

    	$data['intruksi_saya_revisi']=DB::table('task_item')->where([
									    ['assign_to', '=', session('id')],
									    ['status_id', '=', '7'],
									])->count();

    	$data['intruksi_saya_selesai']=DB::table('task_item')->where([
									    ['assign_to', '=', session('id')],
									    ['status_id', '=', '6'],
									])->count();

    	return view('kasie.dashboard.index',$data);
    }
}
