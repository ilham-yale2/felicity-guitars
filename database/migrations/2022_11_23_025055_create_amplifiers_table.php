<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmplifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amplifiers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id');
            $table->string('code');
            $table->string('name')->nullable();
            $table->string('name_2')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->longText('text')->nullable();
            $table->string('status')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_2')->nullable();
            $table->string('meta_text')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('condition')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->string('year')->nullable();
            $table->double('price');
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
        Schema::dropIfExists('ampilifiers');
    }
}
