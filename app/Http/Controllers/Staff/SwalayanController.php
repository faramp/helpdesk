<?php
namespace App\Http\Controllers\Staff;

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

class SwalayanController extends Controller{
	public function index(){
		$data_usulan = DB::table('task_item')->select('task_item.id','task_item.status_id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_to')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->get();
		$data = [
            'data_usulan' => $data_usulan,
		];
		return view('staff.swalayan.index',$data);
	}
	public function create(){
		$pekerjaan = Pekerjaan::all();
		$aktifitas = Aktifitas::all();
		$data = [
			'pekerjaan' => $pekerjaan,
			'aktifitas' => $aktifitas,
		];
		return view('staff.swalayan.create', $data);
	}
	public function store(Request $request){
		$task = Task::create([
			'nomor' =>123,
			'aktifitas_id' => $request->aktifitas,
			'kategori_aktifitas_id' => 1,
			'deskripsi' => $request->deskripsi
		]);

		$task_item = TaskItem::create([
			'task_id' => $task->id,
			'status_id' => 1,
			'assign_to' => 2,
            'assign_by' => 1,
		]);

		return redirect('/staff/datausulan')->with('msg','data berhasil ditambahkan !');
	}
	public function show(){

	}
	public function edit(){

	}
	public function update($id){
		TaskItem::where('id','=',$id)
				->update(['status_id' => 4,
							'waktu_selesai_teknis' => NOW()]);
		return redirect('/staff/datausulan')->with('msg','data berhasil diperbarui !');
	}
	public function destroy(){
		
	}
}

