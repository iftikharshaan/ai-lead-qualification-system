<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
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
        'email' => fake()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'company' => fake()->company(),
        'industry' => fake()->randomElement([
            'Healthcare',
            'Education',
            'Retail',
            'Construction',
            'Technology',
        ]),
        'budget' => fake()->numberBetween(1000, 100000),
        'source' => fake()->randomElement([
            'Website',
            'Facebook',
            'LinkedIn',
            'WhatsApp',
            'Referral',
        ]),
        'status' => fake()->randomElement([
            'new',
            'qualified',
            'contacted',
            'proposal_sent',
            'won',
            'lost',
        ]),
        'score' => fake()->numberBetween(0, 100),
        'requirements' => fake()->paragraph(),
        'ai_summary' => null,
    ];
}
}
