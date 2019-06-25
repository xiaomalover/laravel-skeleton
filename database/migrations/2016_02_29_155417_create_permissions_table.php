<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * 系统权限
 *
 * @author Latrell Chan
 *
 */
class CreatePermissionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function (Blueprint $table) {
			$table->comment = '系统权限';

			$table->string('key', 100)->primary()->comment('key');

			$table->string('name')->comment('名称');

			$table->string('group')->default('')->comment('组名');

			$table->string('remark')->default('')->comment('备注');

			$table->text('actions')->comment('可操作的列表');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('permissions');
	}
}
