<?php

namespace App\Http\Controllers\Kasie;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;


class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data['unit']=DB::table('unit_kerja')->get();
        return view('kasie.unitkerja.index',$data);
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('kasie.unitkerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          DB::table('unit_kerja')->insert(
      ['nama' => $request->nama]
        );

        return redirect('kasie/unitkerja')->with('msg','data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data['unit'] = DB::table('unit_kerja')->where('id',$id)->first();
         return view('kasie.unitkerja.edit',$data);
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
          DB::table('unit_kerja')
            ->where('id', $id)
            ->update(['nama' => $request->nama]);
             return redirect('/kasie/unitkerja')->with('msg','data berhasil diperbarui !');

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           DB::table('unit_kerja')->where('id',$id)->delete();
           return redirect('/kasie/unitkerja')->with('msg2','data berhasil dihapus !');
    }
}
