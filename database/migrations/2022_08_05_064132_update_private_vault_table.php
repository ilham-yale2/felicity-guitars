<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePrivateVaultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('private_vaults');
        Schema::dropIfExists('private_vault_details');
        
        
        Schema::create('private_vaults', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
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
            $table->double('discount');
            $table->double('sell_price');
            $table->timestamps();
        });
        Schema::create('private_vault_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('product_id');
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
        Schema::dropIfExists('private_vaults');
        Schema::dropIfExists('private_vault_details');
    }
}
