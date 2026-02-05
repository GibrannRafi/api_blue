<?php

namespace Database\Factories;

use App\Helper\ImageHelper\ImageHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;
use App\Models\User;
use Nette\Utils\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageHelper = new ImageHelper;

        return [
            'id' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'name' => $this->faker->company(),
            'logo' => $imageHelper->storeAndResizeImage(
                $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                'store',
                250,
                250
            ),
            'about' => $this->faker->paragraph(),
            'phone' => $this->faker->phoneNumber(),
            'address_id' => $this->faker->numberBetween(1, 100),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'postal_code' => $this->faker->postcode(),
            'is_verified' => $this->faker->boolean(70),

        ];
    }
}
