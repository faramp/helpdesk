<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model{
	protected $table = 'task_item';
	protected $primary_key = 'id';
	public $timestamps = false;

	protected $fillable = [
		'task_id',
		'status_id',
		'assign_to',
		'assign_by',
		'waktu_approval',
		'waktu_selesai_teknis',
		'waktu_selesai_penilaian',
		'nilai',
		'pesan'
	];
}