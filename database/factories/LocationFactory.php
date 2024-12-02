<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition()
    {
        static $counter = 1;
        return [
            'name' => 'A' . $counter++, 
        ];
    }
}
