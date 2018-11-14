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
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class SwalayanController extends Controller{

	public function index(){
        $data_usulan = DB::table('task_item')->select('task_item.id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->whereBetween('task_item.status_id',[1,6])
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_to')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->get();
		$data = [
            'data_usulan' => $data_usulan,
		];
		return view('kasie.swalayan.index',$data);
	}

    public function create(){

    }

    public function store(){

    }

    public function show($id){
        $status = Status::whereBetween('id',[1,3])->get();
        $detail_usulan = DB::table('task_item')->select('task_item.id', 'task.id as task_id','aktifitas.nama as nama_aktifitas','user.nama as nama_user', 'status.nama as nama_status', 'task.deskripsi')
                    ->where('task_item.id','=',$id)
                    ->join('task', 'task.id','=', 'task_item.task_id')
                    ->join('aktifitas', 'aktifitas.id','=', 'task.aktifitas_id')
                    ->join('user', 'user.id','=', 'task_item.assign_to')
                    ->join('status', 'status.id', '=', 'task_item.status_id')->first();
        $data = [
            'detail_usulan' => $detail_usulan,
            'status'      => $status,
        ];

        return view ('kasie.swalayan.edit',$data);
    }

    public function edit(){

    }

    public function update(Request $request, $id){
        $status = $request->input('status');

        if($status == 2){
            DB::table('task')
                ->join('task_item','task_item.task_id','=','task.id')
                ->where('task_item.id','=', $request->task_id)
                ->update(['deadline' => date_format(date_create($request->deadline),"Y-m-d")]);  

            DB::table('task_item')
                ->where('id', '=', $id)
                ->update(['status_id' => $status,
                            'waktu_approval' => NOW()]);  
        }
        elseif ($status == 3) {
            DB::table('task_item')
                ->where('id', '=', $id)
                ->update(['pesan' => $request->pesan,
                            'status_id' => $status]);
        }   
            
        return redirect('/kasie/datausulan')->with('msg','data berhasil diperbarui !');
    }

    public function destroy(){

    }
}


