<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriAktifitas extends Model{
	protected $table = 'kategori_aktifitas';
	protected $primary_key = 'id';

	protected $fillable = [
		'nama'
	];
}