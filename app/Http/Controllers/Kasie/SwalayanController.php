<?php
namespace App\Http\Controllers\Kasie;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskItem;
use App\Models\Aktifitas;
use App\Models\Pekerjaan;
use App\Models\User;
use App\Models\Status;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class SwalayanController extends Controller{
//USULKAN PEKERJAAN
    public function usulkanPekerjaan(){
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
        return view('kasie.swalayan.usulan.usulkan_pekerjaan',$data);
    }

    public function createPekerjaan($id){
        $detail = DB::table('aktifitas')->select('aktifitas.id as id_aktifitas','pekerjaan.id as id_pekerjaan','pekerjaan.nama as nama_pekerjaan','aktifitas.nama as nama_aktifitas', 'aktifitas_bobot.nilai')
                    ->where('aktifitas.id','=', $id)
                    ->join('pekerjaan', 'aktifitas.pekerjaan_id','=', 'pekerjaan.id')
                    ->join('aktifitas_bobot', 'aktifitas_bobot.aktifitas_id','=','aktifitas.id')->first();
        $data = [
            'detail' => $detail,
        ];
        return view('kasie.swalayan.usulan.create_pekerjaan', $data);
    }

    public function simpanPekerjaan(Request $request){
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

        return redirect('/kasie/usulansaya')->with('msg','data berhasil ditambahkan !');
    }
//END USULKAN PEKERJAAN
//DATA USULAN SAYA
    public function usulanSaya(){
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
        return view ('kasie.swalayan.usulan.usulan_saya',$data);
    }

    public function detailUsulanSaya($id){
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
        return view ('kasie.swalayan.usulan.detail_usulan_saya',$data);
    }

    public function updateUsulanSaya(Request $request, $id){
        DB::table('task')
                ->join('task_item','task_item.task_id','=','task.id')
                ->where('task_item.id',$id)
                ->update(['deskripsi' => $request->deskripsi]);

        TaskItem::where('id','=',$id)
                ->update(['status_id' => 1]);
        return redirect('/kasie/usulansaya')->with('msg','data berhasil diperbarui !');
    }
//END DATA USULAN SAYA
//DATA USULAN STAF
	public function index(){
        $id_user = Session('id');
        $data_usulan = DB::table('task_item')->select('task_item.id','task_item.status_id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->whereIn('task_item.status_id',[1,3])
                    ->where('task_item.assign_to', $id_user)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_by')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->get();
		$data = [
            'data_usulan' => $data_usulan,
		];
		return view('kasie.swalayan.usulan.index',$data);
	}

    public function show($id){
        $status = Status::whereBetween('id',[1,3])->get();
        $detail_usulan = DB::table('task_item')->select('task_item.id', 'task.id as task_id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->where('task_item.id','=',$id)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_by')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->first();
        $data = [
            'detail_usulan' => $detail_usulan,
            'status'      => $status,
        ];

        return view ('kasie.swalayan.usulan.edit',$data);
    }

    public function update(Request $request, $id){
        $status = $request->input('status');
        if($status == 2){
            DB::table('task')
                ->join('task_item','task_item.task_id','=','task.id')
                ->where('task_item.id','=', $id)
                ->update(['deadline' => date_format(date_create($request->deadline),"Y-m-d H:i:s")]);  

            DB::table('task_item')
                ->where('id', '=', $id)
                ->update(['status_id' => 4,
                            'waktu_approval' => Carbon::now('GMT+7')]);  
        }
        elseif ($status == 3) {
            DB::table('task_item')
                ->where('id', '=', $id)
                ->update(['pesan' => $request->pesan,
                            'status_id' => $status]);
        }   
            
        return redirect('/kasie/datausulanstaf')->with('msg','data berhasil diperbarui !');
    }
//END DATA USULAN STAF
//TASK STAF
    public function taskStaf(){
        $id_user = Session('id');
        $task = DB::table('task_item')->select('task_item.id','task_item.status_id','task_item.nilai','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->whereBetween('task_item.status_id',[4,7])
                    ->where('task_item.assign_to', $id_user)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_by')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->get();
        $data = [
            'task' => $task,
        ];
        return view('kasie.swalayan.task.index',$data);
    }

    public function detailTaskStaf($id){
        $status =  Status::whereBetween('id',[6,7])->get();
        $task = DB::table('task_item')->select('task_item.id','task_item.status_id','task_item.nilai','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi', 'task_item.pesan', 'task_item.waktu_approval', 'task_item.waktu_selesai_teknis','task.deadline')
                    ->where('task_item.id',$id)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_by')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->first();

        $selisih = date_diff(date_create($task->waktu_approval), date_create($task->waktu_selesai_teknis));
        $array_selisih = [$selisih->y, $selisih->m, $selisih->d, $selisih->h, $selisih->i];
        $array_ket = [" tahun ", " bulan ", " hari ", " jam ", " menit"];
        $waktu_pengerjaan = "";
        for($i=0; $i<5; $i++){
            if($array_selisih[$i]!=0){
                $waktu_pengerjaan = $waktu_pengerjaan.$array_selisih[$i].$array_ket[$i];
            }
        }

        $data = [
            'status' => $status,
            'task' => $task,
            'waktu_pengerjaan' => $waktu_pengerjaan,
        ];
        return view('kasie.swalayan.task.edit',$data);
    }

    public function updateTaskStaf(Request $request, $id){
        $status = $request->status;
        if($status == 7){
            TaskItem::where('id','=', $id)
                    ->update(['status_id' => 7,
                                'pesan' => $request->pesan]);   
        }
        elseif ($status == 6) {
            TaskItem::where('id','=', $id)
                    ->update(['status_id' => 6,
                                'nilai' => $request->nilai,
                                'waktu_selesai_penilaian' => Carbon::now('GMT+7')]);
        }

        return redirect('/kasie/datataskstaf')->with('msg', 'data berhasil diperbaharui !');
    }
//END TASK STAF
//TASK SAYA
    public function taskSaya(){
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
        return view ('kasie.swalayan.task.task_saya',$data);
    }

    public function detailTaskSaya($id){
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
        return view ('kasie.swalayan.task.detail_task_saya',$data);
    }

    public function updateTaskSaya(Request $request, $id){
        $status = $request->status;

        if($status == 4){
            TaskItem::where('id',$id)
                        ->update(['status_id' => 5]);
        }
        elseif ($status == 7) {
            DB::table('task')
                ->join('task_item','task_item.task_id','=','task.id')
                ->where('task_item.id',$id)
                ->update(['deskripsi' => $request->deskripsi]);
                
            TaskItem::where('id',$id)
                        ->update(['status_id' => 5]);
        }
        
        return redirect('/kasie/tasksaya')->with('msg','data berhasil diperbaharui !');
    }
//END TASK SAYA
}


