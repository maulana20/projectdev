<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("reasons", function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("code");
            $table->string("information", 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("reasons");
    }
};