<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("traffics", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("hosttohost_id");
            $table->unsignedTinyInteger("reason_code");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traffics');
    }
};