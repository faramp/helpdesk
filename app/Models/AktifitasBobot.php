<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktifitasBobot extends Model{
	protected $table = 'aktifitas_bobot';
	protected $primary_key = 'id';

	protected $fillable = [
		'aktifitas_id',
		'kategori_bobot_id',
		'nilai'
	];
}