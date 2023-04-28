<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmplifierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amplifier_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('amplifier_id');
            $table->longText('general')->nullable();
            $table->longText('body')->nullable();
            $table->longText('neck')->nullable();
            $table->longText('hardware')->nullable();
            $table->longText('electronic')->nullable();
            $table->longText('miscellaneous')->nullable();
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
        Schema::dropIfExists('ampilifier_details');
    }
}
