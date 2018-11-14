<?php

namespace App\Http\Controllers\Staf;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

class DashboardController extends Controller
{

	public function index(){

		$data['intruksi_perintah_belum_selesai']=DB::table('task_item')->where([
									    ['assign_by', '=', session('id')],
									    ['status_id', '=', '4'],
									])->count();

    	$data['intruksi_perintah_menunggu_penilaian']=DB::table('task_item')->where([
									    ['assign_by', '=', session('id')],
									    ['status_id', '=', '5'],
									])->count();

    	$data['intruksi_perintah_revisi']=DB::table('task_item')->where([
									    ['assign_by', '=', session('id')],
									    ['status_id', '=', '7'],
									])->count();

    	$data['intruksi_perintah_selesai']=DB::table('task_item')->where([
									    ['assign_by', '=', session('id')],
									    ['status_id', '=', '6'],
									])->count();
		return view('staf.dashboard.index' , $data);
	}

}