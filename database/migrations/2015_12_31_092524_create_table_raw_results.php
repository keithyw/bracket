<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRawResults extends Migration
{
    private $_table = 'raw_results';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->_table, function(Blueprint $table){
            $table->increments('id');
            $table->string('type');
            $table->text('results')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->_table);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
