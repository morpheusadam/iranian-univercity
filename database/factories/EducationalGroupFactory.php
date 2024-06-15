<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EducationalGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $egs = ['کامپیوتر', 'روانشناسی', 'پزشکی', 'فنی', 'حسابداری', 'حقوق', 'انسانی', 'ریاضی', 'پیراپزشکی', 'مکانیک'];

        return [
            'name' => $egs[rand(0, 9)] . Str::random(2),
            'initials' => Str::random(3)
        ];
    }
}
