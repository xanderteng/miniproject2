<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class CarFactory extends Factory
{
    public function definition()
    {
        $regionCode = $this->faker->randomElement(['B', 'D', 'N', 'L']);
        $number = $this->faker->numberBetween(1000, 9999);
        $alpha = strtoupper($this->faker->lexify('??'));
    
        $licensePlate = "{$regionCode} {$number} {$alpha}";
        $imageName = $this->faker->image(storage_path('app/public/car_images'), 400, 300, null, false);
        $carImageUrl = 'car_images/' . $imageName;

        return [
            'license_plate' => $licensePlate,
            'car_type' => $this->faker->randomElement(['Avanza', 'Xenia', 'Brio', 'Fortuner', 'Xpander', 'Innova', 'Ertiga', 'Sigra']),
            'car_type_image' => $carImageUrl,
            'parked_at' => $this->faker->dateTimeThisMonth(),
            'location_id' => Location::inRandomOrder()->first()->id ?? Location::factory(),
        ];
    }
}
