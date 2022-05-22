<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddeColoumProductionDateAndExpiryDateToMedicationMypharmacysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication_mypharmacys', function (Blueprint $table) {
            $table->date("production_date");
            $table->date("expiry_date");
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
