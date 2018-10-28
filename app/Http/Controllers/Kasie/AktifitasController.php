<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AktifitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['aktifitas'] = DB::table('aktifitas')
            ->join('pekerjaan', 'aktifitas.pekerjaan_id', '=', 'pekerjaan.id')
           
            ->select('aktifitas.*',  'pekerjaan.nama as nama_pekerjaan')
            ->get();
        return view('kasie.aktifitas.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pekerjaan']=DB::table('pekerjaan')->get();
        return view('kasie.aktifitas.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          DB::table('aktifitas')->insert(
      ['nama' => $request->nama , 'pekerjaan_id'=>$request->pekerjaan_id]
        );

        return redirect('kasie/aktifitas')->with('msg','data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $data['pekerjaan']=DB::table('pekerjaan')->get();
        $data['aktifitas'] = DB::table('aktifitas')->where('id',$id)->first();
        return view('kasie.aktifitas.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         DB::table('aktifitas')
            ->where('id', $id)
            ->update(['nama' => $request->nama , 'pekerjaan_id'=>$request->pekerjaan_id , 'status_usulan'=>$request->status_usulan]);
             return redirect('/kasie/aktifitas')->with('msg','data berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         DB::table('aktifitas')->where('id',$id)->delete();
           return redirect('/kasie/aktifitas')->with('msg2','data berhasil dihapus !');
    }
}
