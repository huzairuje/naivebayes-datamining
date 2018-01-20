<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->nullable()->index();
            $table->string('token')->nullable()->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('active')->nullable()->unsigned()->default(1)->comment('0 = Not Active, 1 = Active');
            $table->boolean('is_admin')->nullable()->unsigned()->default(0)->comment('0 = Not Admin, 1 = Admin');
            $table->rememberToken();
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_logout_ip')->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('role_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('controller')->nullable();
            $table->string('model')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('sequence')->nullable()->unsigned();
            $table->boolean('sidebar')->nullable()->unsigned()->default(1)->comment('0 = Hide, 1 = Show');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->integer('role_id')->nullable()->unsigned();
            $table->integer('menu_id')->nullable()->unsigned();
            $table->text('access')->nullable();
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
        Schema::drop('role_menu');
        Schema::drop('roles');
        Schema::drop('menus');
        Schema::drop('password_resets');
        Schema::drop('user_role');
        Schema::drop('users');
    }
}
