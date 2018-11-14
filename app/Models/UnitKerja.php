<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model{
	protected $table = 'unit_kerja';
	protected $primary_key = 'id';

	protected $fillable =[
		'nama'
	];
}