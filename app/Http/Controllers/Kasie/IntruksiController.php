<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

class IntruksiController extends Controller
{
    public function beri_intruksi(){
    	$data['user'] = DB::table('riwayat_jabatan_pegawai')
            ->join('user', 'riwayat_jabatan_pegawai.user_id', '=', 'user.id')
             ->where('riwayat_jabatan_pegawai.atasan_id', '=', session('id'))
           
            ->select('riwayat_jabatan_pegawai.*', 'user.nama')
            ->get();

      //$data['teman_setingkat'] = DB::table('user')->where('jabatan', '=' ,session('jabatan'))->get();    

       $data['teman_setingkat'] = DB::table('user')->where([
                                            ['jabatan', '=', session('jabatan')],
                                            ['id', '!=', session('id')],
                                                      ])->get();    

       // return var_dump( $data['teman_setingkat']);    


    	$data['pekerjaan']=DB::table('pekerjaan')->get();
    	$data['aktifitas']=DB::table('aktifitas')->get();
    	return view('kasie.intruksi.beri_intruksi',$data);


    }

  

    public function get_aktifitas_ajax(Request $request){
    	$x=$_GET['x'];
    	$aktifitas=DB::table('aktifitas')->where('pekerjaan_id', '=', $x)->get();
    	foreach ($aktifitas as $r ) {
			echo "<option value='{$r->id}'>";
            echo "{$r->nama}";
            echo "</option>";
    }
}

 public function get_bawahan_bantuan_ajax(Request $request){
      $z=$_GET['z'];
      //$bawahan=DB::table('riwayat_jabatan_pegawai')->where('atasan_id', '=', $z)->get();

      $bawahan = DB::table('riwayat_jabatan_pegawai')
            ->join('user', 'riwayat_jabatan_pegawai.user_id', '=', 'user.id')
             ->where('riwayat_jabatan_pegawai.atasan_id', '=', $z)
           
            ->select('riwayat_jabatan_pegawai.*', 'user.nama')
            ->get();

       echo "<h4 class='h6 g-font-weight-600 g-color-black g-mb-20'>Pilih Teknisi</h4>";
       echo "<div class='row g-mb-30'>";
        foreach ($bawahan as $r) {
           echo "<div class='col-md-6'>";
           echo "<div class='form-group g-mb-10'>";
           echo "<label class='u-check g-pl-25'>";
           echo "<input class='g-hidden-xs-up g-pos-abs g-top-0 g-left-0' name='bawahan[]' value='{$r->user_id}'' type='checkbox'>";
           echo "<div class='u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0'>";
           echo "<i class='fa' data-check-icon='&#xf00c'>";
           echo "</i>";
           echo "</div>";
           echo "{$r->nama}";
           echo "</label>";
           echo "</div>";
           echo "</div>";
        }
         echo "</div>";
}

    public function create_intruksi(Request $request){

      
        $temp=$request->deadline;
         $date = new DateTime($temp);
         $temp2=date_format($date, 'Y-m-d H:i:s');

        $id=DB::table('task')->insertGetId(
      ['aktifitas_id' => $request->aktifitas_id , 'kategori_aktifitas_id'=>1 , 'deskripsi'=>$request->deskripsi , 'deadline'=>$temp2]
        );

        $user=$request->user;
        $sum=count($user);
        for ($i=0; $i <$sum ; $i++) { 
            DB::table('task_item')->insert(
      ['task_id' => $id , 'status_id'=>4 , 'status_approval_id'=>2 ,  'assign_to'=>session('id') , 'assign_by'=>$user[$i] ]
        );
        }

        if(($request->bantu)==1){
          $bawahan=$request->bawahan;
          $sum=count($bawahan);

            for ($i=0; $i <$sum ; $i++) { 
            DB::table('task_item')->insert(
      ['task_id' => $id , 'status_id'=>8 , 'status_approval_id'=>1 , 'assign_to'=>session('id') , 'assign_by'=>$bawahan[$i] , 'approved_by'=>$request->approved_by ]
        );
        }

        }



        return redirect('/kasie/intruksi/data_intruksi')->with('msg','data Intruksi anda berhasil dibuat !');
     

         


      
    }

    public function data_intruksi(){


            $data['intruksi']= DB::table('task')
                                ->join('task_item', 'task.id', '=', 'task_item.task_id')
                                 ->where('task_item.assign_to', '=', session('id'))
                                  ->join('aktifitas', 'task.aktifitas_id', '=', 'aktifitas.id')
                                   ->join('status', 'task_item.status_id', '=', 'status.id')
                               
                                ->select('task_item.*', 'task.aktifitas_id' , 'task.id as idb' , 'task.deskripsi' , 'task.deadline' , 'aktifitas.nama' ,'status.nama as namas')
                                ->get();
        return view('kasie.intruksi.data_intruksi' , $data);
    }

    public function edit($id ,Request $request){

      $data['intruksi']= DB::table('task_item')
                      ->join('task', 'task_item.task_id', '=', 'task.id')
                        ->join('user', 'task_item.assign_by', '=', 'user.id')
                          ->where('task_item.id', '=', $id)
         ->select('task_item.*', 'task.aktifitas_id' , 'task.deadline' , 'task.deskripsi' , 'user.username' , 'task.created_at')
                      ->first();

     $x= $data['intruksi']->task_id;
      $data['tim']= DB::table('task_item')
                            ->join('user', 'user.id', '=', 'task_item.assign_by')
                             ->join('status', 'status.id', '=', 'task_item.status_id')
                             ->where('task_item.task_id', '=', $x)
                           
                            ->select('task_item.*', 'user.username' , 'status.nama')
                            ->get();


                      $x=$data['intruksi']->created_at;
                      $y=$data['intruksi']->waktu_selesai_teknis;

                     // return var_dump($x , $y);
                      $datetime1=new DateTime($x);
                      $datetime2=new DateTime($y);
                      $interval = $datetime1->diff($datetime2);
                      $data['elapsed'] = $interval->format('%m bulan %a hari %h jam %i menit %s detik');
                      



                 // return var_dump($x);
    return view('kasie.Intruksi.detail_intruksi' , $data);
  }

  public function penilaian($id , Request $request){

    if($request->status_id==6){
       $waktu_selesai_penilaian=date("Y-m-d H:i:s");
      //return var_dump($waktu_selesai_teknis);

     DB::table('task_item')
            ->where('id', $id)
            ->update(['status_id' => 6  , 'waktu_selesai_penilaian' => $waktu_selesai_penilaian , 'nilai'=>$request->nilai]);
             return redirect('/kasie/intruksi/data_intruksi')->with('msg','data Intruksi anda berhasil dinilai !');
    }

    elseif ($request->status_id==7) {
       DB::table('task_item')
            ->where('id', $id)
            ->update(['status_id' => 7  , 'pesan'=>$request->pesan]);
             return redirect('/kasie/intruksi/data_intruksi')->with('msg','data Intruksi anda berhasil dinilai !');
    }

   

  }

  public function izin_bantuan(){
  $data['intruksi']= DB::table('task_item')
                      ->join('task', 'task_item.task_id', '=', 'task.id')
                      ->join('user', 'task_item.assign_by', '=', 'user.id')
                      ->join('status_approval', 'task_item.status_approval_id', '=', 'status_approval.id')
                       ->where('task_item.approved_by', '=', session('id'))
                      ->select('task_item.*', 'task.id as task_id' , 'user.username'  , 'status_approval.nama as nama_status' )
                      ->get();    
  return view('kasie.intruksi.izin_bantuan',$data);
  }

  public function detail_izin($id){
     $data['intruksi']= DB::table('task_item')
                      ->join('task', 'task_item.task_id', '=', 'task.id')
                      ->join('user', 'task_item.assign_by', '=', 'user.id')
                      
                       ->where('task_item.id', '=', $id)
                      ->select('task_item.*', 'task.id as task_id' ,'task.deskripsi' , 'task.deadline' , 'user.username'  )
                      ->first(); 

      $x= $data['intruksi']->task_id;
      //return var_dump($x);
      $data['tim']= DB::table('task_item')
                            ->join('user', 'user.id', '=', 'task_item.assign_by')
                               ->join('status', 'status.id', '=', 'task_item.status_id')
                           
                             ->where('task_item.task_id', '=', $x)
                           
                            ->select('task_item.*', 'user.username' , 'status.nama')
                            ->get();

        $data['status']=DB::table('status_approval')
         ->get();


        //return var_dump($data['status']);
        return view('kasie.intruksi.detail_izin_bantuan' , $data);
  }

  public function edit_izin($id , Request $request){

   
   if(($request->status_approval_id)==2){
     DB::table('task_item')
            ->where('id', $id)
            ->update(['status_approval_id' => $request->status_approval_id , 'status_id'=>4]);
             return redirect('/kasie/intruksi/izin_bantuan')->with('msg','data berhasil diperbarui !');
   }

   elseif (($request->status_approval_id)==3) {
      DB::table('task_item')
            ->where('id', $id)
            ->update(['status_approval_id' => $request->status_approval_id , 'status_id'=>3]);
             return redirect('/kasie/intruksi/izin_bantuan')->with('msg','data berhasil diperbarui !');
   }
    
  }

  public function perintah_intruksi(){

            $data['intruksi']= DB::table('task')
                      ->join('task_item', 'task.id', '=', 'task_item.task_id')
                       ->where('task_item.assign_by', '=', session('id'))
                        ->where('task_item.status_approval_id', '=', 2)
                      
                        ->join('aktifitas', 'task.aktifitas_id', '=', 'aktifitas.id')
                         ->join('status', 'task_item.status_id', '=', 'status.id')
                     
                      ->select('task_item.*', 'task.aktifitas_id' , 'task.id as idb' , 'task.deskripsi' , 'task.deadline' , 'aktifitas.nama' ,'status.nama as namas')
                      ->get();


    return view('kasie.intruksi.perintah_intruksi',$data);
  }

  public function detail_perintah_intruksi($id ,Request $request){

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
    return view('kasie.intruksi.detail_perintah_intruksi' , $data);
  }

  public function kumpulkan($id){

    $waktu_selesai_teknis=date("Y-m-d H:i:s");
    //return var_dump($waktu_selesai_teknis);

     DB::table('task_item')
            ->where('id', $id)
            ->update(['status_id' => 5  , 'waktu_selesai_teknis' => $waktu_selesai_teknis]);
             return redirect('/kasie/intruksi/perintah_intruksi')->with('msg','data Intruksi berhasil dikumpulkan !');

  }


}
