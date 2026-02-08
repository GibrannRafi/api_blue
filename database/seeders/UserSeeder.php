<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreBallance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ini akan membuat 10 Store, dan untuk setiap store dibuatkan 1 StoreBallance
        Store::factory()->count(10)->create()->each(function ($store) {
            StoreBallance::factory()->create([
                'store_id' => $store->id,
            ]);
        });
    }
}
