<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(),
            'education' => fake()->randomElement([
                'Bachelor of Computer Science',
                'Master of Business Administration',
                'Bachelor of Engineering',
                'Master of Information Technology',
            ]),
            'location' => fake()->city() . ', Indonesia',
            'skills' => fake()->randomElement([
                'PHP, Laravel, MySQL',
                'JavaScript, React, Node.js',
                'Python, Django, PostgreSQL',
                'Java, Spring Boot, MongoDB',
            ]),
            'notes' => fake()->sentence(),
        ];
    }
}
