<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatanPegawai extends Model{
	protected $table = 'riwayat_jabatan_pegawai';
	protected $primary_key = 'id';

	protected $fillable = [
		'user_id',
		'unit_kerja_id',
		'atasan_id',
		'status'
	];
}