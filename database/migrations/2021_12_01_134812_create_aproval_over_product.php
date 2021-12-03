<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprovalOverProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('aproval_over_product', function (Blueprint $table) {
        //     $table->id();

        //     $table->unsignedBigInteger('over_product_id');
        //     $table->unsignedBigInteger('aproval_id');

        //     $table->foreign('over_product_id')->references('id')->on('over_products')->onDelete('cascade');;
        //     $table->foreign('aproval_id')->references('id')->on('aprovals')->onDelete('cascade');;

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('aproval_over_product');
    }
}
