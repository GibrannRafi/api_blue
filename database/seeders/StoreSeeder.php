<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\StoreBallance;
use App\Models\StoreBallanceHistory;
use App\Models\Withdrawal;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory()->count(10)->create()->each(function ($store){
           $storeBallance =  StoreBallance::factory()->create([
                'store_id' => $store->id,
            ]);
            StoreBallanceHistory::factory()->create([
                'store_ballance_id' => $storeBallance->id,
                'amount' => $storeBallance->balance,
            ]);
            Withdrawal::factory()->count(1)->create([
                'store_ballance_id' => $storeBallance->id,
            ]);
        });
    }
}
