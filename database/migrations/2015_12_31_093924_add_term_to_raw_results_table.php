<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTermToRawResultsTable extends Migration
{
    private $_table = 'raw_results';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->_table, function(Blueprint $table){
            $table->string('term');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->_table, function(Blueprint $table){
            $table->dropColumn('term');
        });
    }
}
