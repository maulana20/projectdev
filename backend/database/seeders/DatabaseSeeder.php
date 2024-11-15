<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(HosttohostSeeder::class);
        $this->call(ReasonSeeder::class);
    }
}