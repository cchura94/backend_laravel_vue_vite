<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_proveedor', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("producto_id")->unsigned();
            $table->bigInteger("proveedor_id")->unsigned();

            // N:M
            $table->foreign("proveedor_id")->references("id")->on("proveedors");
            $table->foreign("producto_id")->references("id")->on("productos");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_proveedor');
    }
};
