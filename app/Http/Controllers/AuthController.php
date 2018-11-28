<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

	function index(){
		return view('login');
	}

	 function ceklogin(Request $request){
    	$email=$request->email;
    	$password=$request->password_hash;
    	

		$users = DB::table('user')->where([
		   				 ['email', '=', $email],
		    			['password_hash', '=', md5($password)],
						])->get();

		$user = DB::table('user')->where([
		   				 ['email', '=', $email],
		    			['password_hash', '=',  md5($password)],
						])->first();

		
	
		
		$hasil=$users->count();
		
		if($hasil==1){

			$request->session()->put('jabatan', $user->jabatan);
			$request->session()->put('nama', $user->username);
			$request->session()->put('id', $user->id);
			$jabatan=	$request->session()->get('jabatan');
			$nama=$request->session()->get('nama');
			$id=$request->session()->get('id');
			if($jabatan==1){
				
				echo "berhasil";
			}

			elseif ($jabatan==2) {
				return redirect('/kasubdit/dashboard');
			}

			elseif ($jabatan==3) {
				return redirect('/kasie/dashboard');
			}

			elseif ($jabatan==4) {
				return redirect('/staf/dashboard');
			}

			
		}

		else{
			return redirect('/helpdesk/login')->with('msg','email / password anda tidak sesuai');echo "gagal";
		}



    }

    function logout(Request $request){
    	$request->session()->forget('jabatan');
    	$request->session()->forget('nama');
    	$request->session()->forget('id');
    	$request->session()->flush();
    	return redirect('/helpdesk/login');
    }


}