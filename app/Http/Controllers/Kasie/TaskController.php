<?php
namespace App\Http\Controllers\Kasie;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskItem;
use App\Models\Aktifitas;
use App\Models\Pekerjaan;
use App\Models\User;
use App\Models\Status;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class TaskController extends Controller{
	public function index(){
		$task = DB::table('task_item')->select('task_item.id','task_item.status_id','task_item.nilai','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
					->whereBetween('task_item.status_id',[4,6])
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_to')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->get();
		$data = [
            'task' => $task,
		];
		return view('kasie.swalayan.task.index',$data);
	}
	public function create(){
	}

	public function store(){
	}

	public function show($id){
		$status =  Status::whereBetween('id',[4,6])->get();
		$task = DB::table('task_item')->select('task_item.id','task_item.status_id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
					->where('task_item.id',$id)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_to')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->first();
		$data = [
			'status' => $status,
            'task' => $task,
		];
		return view('kasie.swalayan.task.edit',$data);
	}

	public function edit(){
	}

	public function update(Request $request, $id){
		$status = $request->status;
		if($status == 5){
			TaskItem::where('id','=',$id)
				->update(['status_id' => 5,
							'pesan'	=> $request->pesan]);	
		}
		elseif ($status == 6) {
			TaskItem::where('id','=', $id)
					->update(['status_id' => 6,
								'nilai' => $request->nilai,
								'waktu_selesai_penelitian' => NOW()]);
		}

		return redirect('/kasie/task')->with('msg','data berhasil diperbarui !');
	}

	public function destroy(){
		
	}
}

