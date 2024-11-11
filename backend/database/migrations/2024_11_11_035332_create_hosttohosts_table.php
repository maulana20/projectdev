<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\HostToHost\IdentifierEnum;
use App\Enums\HostToHost\IOEnum;
use App\Enums\StatusEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("hosttohosts", function (Blueprint $table) {
            $table->id();
            $table->string("identifier", 15);
            $table->string("io", 15);
            $table->string("name", 50);
            $table->string("description")->nullable();
            $table->unsignedTinyInteger("priority")->default(1);
            $table->boolean("status")->default(StatusEnum::INACTIVE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("hosttohosts");
    }
};
