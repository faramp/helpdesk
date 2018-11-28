<?php
namespace App\Http\Controllers\Staf;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskItem;
use App\Models\Aktifitas;
use App\Models\Pekerjaan;
use App\Models\User;
use App\Models\Status;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class SwalayanController extends Controller{
// USULAN
	public function index(){
		$id_user = Session('id');
		$data_usulan = DB::table('aktifitas')->select('aktifitas.id','pekerjaan.nama as nama_pekerjaan','aktifitas.nama as nama_aktifitas', 'aktifitas_bobot.nilai')
					->where('user.id','=', $id_user)
                    ->join('pekerjaan', 'aktifitas.pekerjaan_id','=', 'pekerjaan.id')
                    ->join('aktifitas_bobot', 'aktifitas_bobot.aktifitas_id','=','aktifitas.id')
                    ->join('unit_kerja', 'pekerjaan.unit_kerja_id','=', 'unit_kerja.id')
                    ->join('riwayat_jabatan_pegawai', 'riwayat_jabatan_pegawai.unit_kerja_id','=', 'unit_kerja.id')                    
                    ->join('user', 'user.id', '=', 'riwayat_jabatan_pegawai.user_id')->get();
		$data = [
            'data_usulan' => $data_usulan,
		];
		return view('staf.swalayan.usulan.index',$data);
	}
	public function createUsulan($id){
		$detail = DB::table('aktifitas')->select('aktifitas.id as id_aktifitas','pekerjaan.id as id_pekerjaan','pekerjaan.nama as nama_pekerjaan','aktifitas.nama as nama_aktifitas', 'aktifitas_bobot.nilai')
					->where('aktifitas.id','=', $id)
                    ->join('pekerjaan', 'aktifitas.pekerjaan_id','=', 'pekerjaan.id')
                    ->join('aktifitas_bobot', 'aktifitas_bobot.aktifitas_id','=','aktifitas.id')->first();
		$data = [
			'detail' => $detail,
		];
		return view('staf.swalayan.usulan.create', $data);
	}
	public function simpanUsulan(Request $request){
		$id_user = Session('id');
		$atasan = DB::table('riwayat_jabatan_pegawai')->where('user_id','=',$id_user)->first();

		$task = Task::create([
			'aktifitas_id' => $request->aktifitas,
			'kategori_aktifitas_id' => 1,
			'deskripsi' => $request->deskripsi
		]);

		$task_item = TaskItem::create([
			'task_id' => $task->id,
			'status_id' => 1,
			'assign_to' => $atasan->atasan_id,
            'assign_by' => $id_user,
		]);

		return redirect('/staf/datausulan')->with('msg','data berhasil ditambahkan !');
	}

	public function updateUsulan(Request $request, $id){
		DB::table('task')
				->join('task_item','task_item.task_id','=','task.id')
				->where('task_item.id',$id)
				->update(['deskripsi' => $request->deskripsi]);

		TaskItem::where('id','=',$id)
				->update(['status_id' => 1]);
		return redirect('/staf/datausulan')->with('msg','data berhasil diperbarui !');
	}

	public function dataUsulan(){
		$id_user = Session('id');
		$usulan = DB::table('task_item')->select('task_item.id','aktifitas.nama as nama_aktifitas','pekerjaan.nama as nama_pekerjaan','task.deskripsi','status.nama as nama_status','task_item.status_id')
					->where('assign_by','=',$id_user)
					->whereIn('status_id',[1,3])
					->join('task','task_item.task_id','=','task.id')
					->join('aktifitas','task.aktifitas_id','=','aktifitas.id')
					->join('pekerjaan','aktifitas.pekerjaan_id','=','pekerjaan.id')
					->join('status','task_item.status_id','=','status.id')->get();
		$data = [
			'usulan' => $usulan,
			];
		return view ('staf.swalayan.usulan.show',$data);
	}

	public function detailUsulan($id){
		$detail = DB::table('task_item')->select('task_item.id','aktifitas.nama as nama_aktifitas','pekerjaan.nama as nama_pekerjaan','task.deskripsi','status.nama as nama_status','task_item.status_id', 'aktifitas_bobot.nilai', 'task_item.pesan')
					->where('task_item.id','=',$id)
					->join('task','task_item.task_id','=','task.id')
					->join('aktifitas','task.aktifitas_id','=','aktifitas.id')
					->join('pekerjaan','aktifitas.pekerjaan_id','=','pekerjaan.id')
					->join('aktifitas_bobot', 'aktifitas_bobot.aktifitas_id','=','aktifitas.id')
					->join('status','task_item.status_id','=','status.id')->first();
		$data = [
			'detail' => $detail,
			];
		return view ('staf.swalayan.usulan.detailusulan',$data);
	}
// END USULAN
// TASK
	public function dataTask(){
		$id_user = Session('id');
		$usulan = DB::table('task_item')->select('task_item.id','aktifitas.nama as nama_aktifitas','pekerjaan.nama as nama_pekerjaan','task.deskripsi','status.nama as nama_status','task_item.status_id')
					->where('assign_by','=',$id_user)
					->whereBetween('status_id',[4,7])
					->join('task','task_item.task_id','=','task.id')
					->join('aktifitas','task.aktifitas_id','=','aktifitas.id')
					->join('pekerjaan','aktifitas.pekerjaan_id','=','pekerjaan.id')
					->join('status','task_item.status_id','=','status.id')->get();
		$data = [
			'usulan' => $usulan,
			];
		return view ('staf.swalayan.task.index',$data);
	}

	public function detailTask($id){
		$detail = DB::table('task_item')->select('task_item.id','aktifitas.nama as nama_aktifitas','pekerjaan.nama as nama_pekerjaan','task.deskripsi','status.nama as nama_status','task_item.status_id','aktifitas_bobot.nilai', 'task_item.pesan')
					->where('task_item.id',$id)
					->join('task','task_item.task_id','=','task.id')
					->join('aktifitas','task.aktifitas_id','=','aktifitas.id')
					->join('pekerjaan','aktifitas.pekerjaan_id','=','pekerjaan.id')
					->join('aktifitas_bobot', 'aktifitas_bobot.aktifitas_id','=','aktifitas.id')
					->join('status','task_item.status_id','=','status.id')->first();
		$data = [
			'detail' => $detail,
			];
		return view ('staf.swalayan.task.detailtask',$data);
	}

	public function updateTask(Request $request, $id){
		$status = $request->status;

		if($status == 4){
			TaskItem::where('id',$id)
						->update(['status_id' => 5,
								'waktu_selesai_teknis' => Carbon::now('GMT+7')]);
		}
		elseif ($status == 7) {
			DB::table('task')
				->join('task_item','task_item.task_id','=','task.id')
				->where('task_item.id',$id)
				->update(['deskripsi' => $request->deskripsi]);
				
			TaskItem::where('id',$id)
						->update(['status_id' => 5]);
		}
		
		return redirect('/staf/datatask')->with('msg','data berhasil diperbaharui !');
	}
// END TASK

}

