<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model{
	protected $table = 'aktifitas';
	protected $primary_key = 'id';

	protected $fillable = [
		'nama',
		'pekerjaan_id',
		'status_usulan',
		'pesan'
	];
}