<?php

namespace Database\Factories;

use App\Models\StoreBallance;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    protected $model = Withdrawal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_ballance_id' => StoreBallance::factory(),
            'amount' => function (array $attributes) {
                $storeBallance = StoreBallance::find($attributes['store_ballance_id']);
                return $this->faker->randomFloat(2, 0,  $storeBallance->balance);
            },
            'bank_account_name' => $this->faker->name(),
            'bank_account_number' => $this->faker->numerify('##########'),
            'bank_name' => $this->faker->randomElement(['BNI', 'Mandiri', 'BCA', 'BRI',]),
            'status' => 'pending',
           
        ];
    }
    public function configure(): static
{
    return $this->afterCreating(function (Withdrawal $withdrawal) {

        // Histori permintaan penarikan (pending)
        $withdrawal->storeBallance->storeBallanceHistories()->create([
            'type' => 'withdraw',
            'reference_id' => $withdrawal->id,
            'reference_type' => Withdrawal::class,
            'amount' => -$withdrawal->amount,
            'remarks' => "Permintaan penarikan dana ke {$withdrawal->bank_name} - {$withdrawal->bank_account_number}",
        ]);

        // Penarikan dana (proses)
        $withdrawal->storeBallance->storeBallanceHistories()->create([
            'type' => 'withdraw',
            'reference_id' => $withdrawal->id,
            'reference_type' => Withdrawal::class,
            'amount' => -$withdrawal->amount,
            'remarks' => "Permintaan penarikan dana ke {$withdrawal->bank_name} - {$withdrawal->bank_account_number} telah di proses",
        ]);

        // Update status menjadi approved
        $withdrawal->update([
            'status' => 'approved'
        ]);

        // Kurangi saldo di tabel store_balances
        $withdrawal->storeBallance->update([
            'balance' => $withdrawal->storeBallance->balance - $withdrawal->amount,
        ]);
    });
}
}
