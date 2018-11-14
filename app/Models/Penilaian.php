<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model{
	protected $table = 'penilaian';
	protected $primary_key = 'id';

	protected $fillable = [
		'task_item_id',
		'kategori_nilai_id'
	];
}