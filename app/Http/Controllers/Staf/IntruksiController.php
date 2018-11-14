<?php

namespace App\Http\Controllers\Staf;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

class IntruksiController extends Controller
{

	public function index(){

            $data['intruksi']= DB::table('task')
					            ->join('task_item', 'task.id', '=', 'task_item.task_id')
					             ->where('task_item.assign_by', '=', session('id'))
					              ->where('task_item.status_approval_id', '=', 2)
					            
					              ->join('aktifitas', 'task.aktifitas_id', '=', 'aktifitas.id')
					               ->join('status', 'task_item.status_id', '=', 'status.id')
					           
					            ->select('task_item.*', 'task.aktifitas_id' , 'task.id as idb' , 'task.deskripsi' , 'task.deadline' , 'aktifitas.nama' ,'status.nama as namas')
					            ->get();


		return view('staf.Intruksi.index',$data);
	}

	public function edit($id ,Request $request){

		  $data['intruksi']= DB::table('task_item')
					            ->join('task', 'task_item.task_id', '=', 'task.id')
					              ->join('user', 'task_item.assign_to', '=', 'user.id')
					                ->where('task_item.id', '=', $id)
				 ->select('task_item.*', 'task.aktifitas_id' , 'task.deadline' , 'task.deskripsi' , 'user.username')
					            ->first();

		$x= $data['intruksi']->task_id;
	    $data['tim']= DB::table('task_item')
								            ->join('user', 'user.id', '=', 'task_item.assign_by')
								             ->join('status', 'status.id', '=', 'task_item.status_id')
								             ->where('task_item.task_id', '=', $x)
								           
								            ->select('task_item.*', 'user.username' ,'status.nama')
								            ->get();



								 // return var_dump($x);
		return view('staf.Intruksi.edit' , $data);
	}

	public function kumpulkan($id){

		$waktu_selesai_teknis=date("Y-m-d H:i:s");
		//return var_dump($waktu_selesai_teknis);

		 DB::table('task_item')
            ->where('id', $id)
            ->update(['status_id' => 5  , 'waktu_selesai_teknis' => $waktu_selesai_teknis]);
             return redirect('/staf/intruksi')->with('msg','data Intruksi berhasil dikumpulkan !');

	}



}