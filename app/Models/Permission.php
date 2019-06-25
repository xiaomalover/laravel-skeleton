<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	protected $primaryKey = 'key';

	public $incrementing = false;

	protected $guarded = [
		'created_at',
		'updated_at'
	];

	protected $casts = [
		'key' => 'string',
		'name' => 'string',
		'group' => 'string',
		'remark' => 'string',
		'actions' => 'collection',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	/**
	 * 角色列表
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_permissions')->withTimestamps();
	}

	/**
	 * 直属管理员列表
	 */
	public function admins()
	{
		return $this->belongsToMany(Admin::class, 'admin_permissions')->withTimestamps();
	}
}
