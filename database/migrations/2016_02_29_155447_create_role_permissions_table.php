<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * 角色拥有的权限
 *
 * @author Latrell Chan
 *
 */
class CreateRolePermissionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->comment = '角色拥有的权限';

            $table->increments('id');

            $table->unsignedBigInteger('role_id')->comment('所属角色');
            $table->string('permission_key', 100)->comment('拥有的权限');
            $table->unique([
                'role_id',
                'permission_key'
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
        Schema::dropIfExists('role_permissions');
    }
}
