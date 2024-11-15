<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusEnum;
use App\Enums\UsingEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("interfaces", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("hosttohost_id");
            $table->string("name", 50);
            $table->string("username", 50);
            $table->string("password", 50);
            $table->string("url");
            $table->boolean("using")->default(UsingEnum::NO);
            $table->string("session", 100)->nullable();
            $table->boolean("status")->default(StatusEnum::INACTIVE);
            $table->timestamp("used_at")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("interfaces");
    }
};
