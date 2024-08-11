<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('electrical_parts', function (Blueprint $table) {
            $table->id();
            $table->float('voltage')->nullable();
            $table->float('current')->nullable();
            $table->float('power_rating')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('electrical_parts');
    }
};
