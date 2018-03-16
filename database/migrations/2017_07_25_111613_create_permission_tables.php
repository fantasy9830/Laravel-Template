<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    const CONNECTION = 'pgsql';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(self::CONNECTION)
            ->create('auth_roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique()->comment('Unique name for the Role, used for looking up role information in the application layer. For example: "admin", "owner", "employee".');
                $table->string('guard_name');
                $table->string('display_name')->unique()->nullable()->comment('Human readable name for the Role. Not necessarily unique and optional. For example: "User Administrator", "Project Owner", "Widget Co. Employee".');
                $table->string('description')->nullable()->comment('A more detailed explanation of what the Role does. Also optional.');
                $table->timestamps();
            });

        Schema::connection(self::CONNECTION)
            ->create('auth_permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique()->comment('Unique name for the permission, used for looking up permission information in the application layer. For example: "create-post", "edit-user", "post-payment", "mailing-list-subscribe".');
                $table->string('guard_name');
                $table->string('display_name')->unique()->nullable()->comment('Human readable name for the permission. Not necessarily unique and optional. For example "Create Posts", "Edit Users", "Post Payments", "Subscribe to mailing list".');
                $table->string('description')->nullable()->comment('A more detailed explanation of the Permission.');
                $table->timestamps();
            });

        Schema::connection(self::CONNECTION)
            ->create('auth_permission_role', function (Blueprint $table) {
                $table->integer('permission_id')->unsigned();
                $table->integer('role_id')->unsigned();

                $table->foreign('permission_id')
                    ->references('id')
                    ->on('auth_permissions')
                    ->onDelete('cascade');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('auth_roles')
                    ->onDelete('cascade');

                $table->primary(['permission_id', 'role_id']);
            });

        Schema::connection(self::CONNECTION)
            ->create('auth_role_user', function (Blueprint $table) {
                $table->integer('role_id')->unsigned();
                $table->string('user_id');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('auth_roles')
                    ->onDelete('cascade');

                $table->primary(['user_id', 'role_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(self::CONNECTION)->dropIfExists('auth_permission_role');
        Schema::connection(self::CONNECTION)->dropIfExists('auth_role_user');
        Schema::connection(self::CONNECTION)->dropIfExists('auth_roles');
        Schema::connection(self::CONNECTION)->dropIfExists('auth_permissions');
    }
}
