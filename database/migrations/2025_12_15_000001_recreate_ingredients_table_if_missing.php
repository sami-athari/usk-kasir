<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('ingredients')) {
            return;
        }

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('stock');
            $table->string('unit');
            $table->integer('cost_per_unit')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
