<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddeColoumQuntityAndStatusToMedicationMypharmacysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication_mypharmacys', function (Blueprint $table) {
            $table->integer('quntity');
            $table->double('price');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication_mypharmacys', function (Blueprint $table) {
            //
        });
    }
}
