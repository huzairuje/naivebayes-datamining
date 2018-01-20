<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoring', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penghasilan')->unsigned()->nullable();
            $table->integer('pekerjaan')->unsigned()->nullable();
            $table->integer('pengeluaran')->unsigned()->nullable();
            $table->integer('status_kawin')->unsigned()->nullable();
            $table->boolean('score')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoring');
    }
}
