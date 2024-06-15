<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $professors = ['محسنی', 'بهبودی', 'اکرمی', 'محمدی', 'سلیمانی', 'لیما', 'سهیل پور', 'ایمانی', 'یزدی', 'طباطبائی'];

        return [
            'name' => $professors[rand(0, 9)] . Str::random(2)
        ];
    }
}
