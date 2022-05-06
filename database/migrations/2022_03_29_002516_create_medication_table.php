<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication', function (Blueprint $table) {
            $table->id();
            $table->string("trade_name",255);
            $table->string("scientific_name",255);
            $table->string("made_in",255);
            $table->string("quntity",255);
            $table->integer("categorie_id");
            $table->date("production_date");
            $table->date("expiry_date");
            $table->tinyInteger("statuse");
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
        Schema::dropIfExists('medication');
    }
}
