<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mechanical_parts', function (Blueprint $table) {
            $table->id();
            $table->string('material')->nullable();
            $table->string('dimensions')->nullable();
            $table->float('weight')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mechanical_parts');
    }
};
