<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * 管理员拥有的角色
 *
 * @author Latrell Chan
 *
 */
class CreateAdminRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->comment = '管理员拥有的角色';

            $table->increments('id');

            $table->unsignedBigInteger('admin_id')->comment('所属管理员');
            $table->unsignedBigInteger('role_id')->comment('拥有的角色');
            $table->unique([
                'admin_id',
                'role_id'
            ]);

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
        Schema::dropIfExists('admin_roles');
    }
}
