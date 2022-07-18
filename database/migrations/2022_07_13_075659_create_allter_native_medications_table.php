<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllterNativeMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allter_native_pharmacys', function (Blueprint $table) {
            $table->id();
            $table->integer('allter_native_id');
            $table->integer("price");
            $table->double("quntity");
            $table->tinyInteger('status')->default(1);
            $table->date("production_date");
            $table->date("expiry_date");
            $table->string("user_id",255);
            $table->string("mypharmacy_id",255);
            $table->string('medication_id',255);
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
        Schema::dropIfExists('allter_native_medications');
    }
}
