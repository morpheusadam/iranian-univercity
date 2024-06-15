<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lessons = ['سیستم عامل', 'دفاع', 'شبکه', 'تحلیل طراحی', 'زبان', 'مدار منطقی', 'ورزش', 'قران', 'کارگاه', 'وصایا', 'شی گرایی'];
        return [
            'name' => $lessons[rand(0, 10)] . Str::random(2)
        ];
    }
}
