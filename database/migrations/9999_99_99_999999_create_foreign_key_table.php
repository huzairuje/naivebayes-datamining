<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_role', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('menus', function ($table) {
            $table->foreign('parent_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('role_menu', function ($table) {
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_menu', function ($table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['menu_id']);
        });

        Schema::table('menus', function ($table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::table('user_role', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
