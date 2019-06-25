<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	protected $guarded = [
		'created_at',
		'updated_at'
	];

	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'remark' => 'string',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	/**
	 * 权限列表
	 */
	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_key')->withTimestamps();
	}
}
