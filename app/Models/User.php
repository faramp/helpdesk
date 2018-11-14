<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
	protected $table = 'user';
	protected $primary_key = 'id';

	protected $fillable =[
		'username',
		'password_hash',
		'nama',
		'no_hp',
		'email',
		'tanggal_lahir',
		'jenis_kelamin'
	];
}