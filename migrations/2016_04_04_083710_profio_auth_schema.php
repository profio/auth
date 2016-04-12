<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AuthSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->unsignedInteger('role_id');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedInteger('person_id')->index();
            $table->string('person_type')->index();
            $table->unsignedInteger('major_id')->index();
        });

        Schema::create('workflows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('workflow_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('workflow_id')->references('id')->on('workflows')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id', 'workflow_id']);
        });

        // Create table for storing menus
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('icon')->nullable();
        });

        // Create table for associating menus to roles (Many-to-Many)
        Schema::create('menu_role', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('workflow_id')->unsigned();

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('workflow_id')->references('id')->on('workflows')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['menu_id', 'role_id', 'workflow_id']);
        });

        // Create table for associating menus to permissions (Many-to-Many)
        Schema::create('menu_permission', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('permission_id');

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('workflows');
        Schema::drop('roles');
        Schema::drop('role_user');
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('menus');
        Schema::drop('menu_role');
        Schema::drop('menu_permission');
    }
}
