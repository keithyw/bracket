<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRawMessages extends Migration
{
    private $_table = 'raw_messages';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->_table, function(Blueprint $table){
            $table->increments('id');
            $table->text('message')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table($this->_table, function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->_table);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

