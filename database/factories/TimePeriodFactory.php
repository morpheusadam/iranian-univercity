<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimePeriod>
 */
class TimePeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $periods = ['7 - 10:5', '10:5 - 11', '11 - 12:45', '1 - 2:30', '3 - 4', '4 - 5:30', '6 - 7:30'];

        return [
            'period' => $periods[rand(0, 6)]
        ];
    }
}
