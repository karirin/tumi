<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('image')->nullable(true);
            $table->integer('age')->nullable(true);
            $table->text('occupation')->nullable(true);
            $table->text('profile')->nullable(true);
            $table->text('address')->nullable(true);
            $table->text('skill')->nullable(true);
            $table->text('licence')->nullable(true);
            $table->text('workhistory')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->text('remember_token')->nullable(true);
            $table->text('password')->nullable(true);
            $table->text('email')->nullable(true);
            $table->integer('top_flg')->nullable(true);
            $table->integer('match_flg')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
