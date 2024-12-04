<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Car;

class ParkingLotSeeder extends Seeder
{
    public function run()
    {
        
        for ($i = 1; $i <= 10; $i++) {
            Location::updateOrCreate(
                ['name' => 'A' . $i], 
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        //20 Factory
        Car::factory(20)->create();
    }
}
