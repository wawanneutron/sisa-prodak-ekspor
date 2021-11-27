<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('no_po');
            $table->string('nama_barang');
            $table->string('satuan')->default('karton');
            $table->bigInteger('qty');
            $table->date('tgl_produksi');
            $table->date('tgl_export');
            $table->string('export_country');
            $table->date('expired');
            $table->enum('status', ['Export']);
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
        Schema::dropIfExists('products');
    }
}
