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
        Schema::create('field_prices', function (Blueprint $table) {
            $table->primary(['field_id', 'hour']);
            $table->unsignedBigInteger('field_id');
            $table->unsignedTinyInteger('hour');
            $table->unsignedDecimal('price');
            $table->timestamps();
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_prices', function (Blueprint $table) {
            $table->dropForeign('field_prices_field_id_foreign');
        });
        Schema::dropIfExists('field_prices');
    }
};
