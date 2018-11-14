<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
	protected $table = 'task';
	protected $primary_key = 'id';

	protected $fillable = [
		'nomor',
		'aktifitas_id',
		'kategori_aktifitas_id',
		'deskripsi',
		'deadline'
	];
}