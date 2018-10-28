<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pekerjaan'] = DB::table('pekerjaan')
            ->join('unit_kerja', 'pekerjaan.unit_kerja_id', '=', 'unit_kerja.id')
           
            ->select('pekerjaan.*',  'unit_kerja.nama as namas')
            ->get();
           // return var_dump( $data['pekerjaan']);
        return view('kasie.pekerjaan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['unit']=DB::table('unit_kerja')->get();
        return view('kasie.pekerjaan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         DB::table('pekerjaan')->insert(
      ['nama' => $request->nama , 'unit_kerja_id'=>$request->unit_kerja_id]
        );

        return redirect('kasie/pekerjaan')->with('msg','data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data['unit']=DB::table('unit_kerja')->get();
         $data['pekerjaan'] = DB::table('pekerjaan')->where('id',$id)->first();
         return view('kasie.pekerjaan.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
          DB::table('pekerjaan')
            ->where('id', $id)
            ->update(['nama' => $request->nama , 'unit_kerja_id'=>$request->unit_kerja_id , 'status_usulan'=>$request->status_usulan]);
             return redirect('/kasie/pekerjaan')->with('msg','data berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           DB::table('pekerjaan')->where('id',$id)->delete();
           return redirect('/kasie/pekerjaan')->with('msg2','data berhasil dihapus !');
    }
}
