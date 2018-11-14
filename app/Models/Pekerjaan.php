<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model{
	protected $table = 'pekerjaan';
	protected $primary_key = 'id';

	protected $fillable = [
		'nama',
		'unit_kerja_id',
		'status_usulan'
	];
}