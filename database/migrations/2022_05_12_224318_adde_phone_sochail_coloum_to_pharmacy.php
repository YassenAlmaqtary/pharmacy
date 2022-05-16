<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddePhoneSochailColoumToPharmacy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mypharmacys', function (Blueprint $table) {
            $table->string('pdf_path',255);
            $table->string('mobile1',9);
            $table->string('mobile2',9);
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy', function (Blueprint $table) {
            //
        });
    }
}
