<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->bigInteger('qty_over');
            $table->enum('kondisi', [
                'bagus',
                'rusak',
                'expired'
            ]);
            $table->text('note');
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
        Schema::dropIfExists('over_products');
    }
}
