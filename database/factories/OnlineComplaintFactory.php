<?php

namespace Database\Factories;

use App\Models\OnlineComplaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OnlineComplaint>
 */
class OnlineComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_id_number' => 'PLG' . $this->faker->randomNumber(6, true),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'complaint_type' => $this->faker->randomElement(['billing', 'water_quality', 'water_pressure', 'service_connection', 'pipe_damage', 'meter_reading', 'other']),
            'subject' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'resolved', 'closed']),
            'attachments' => null,
            'admin_response' => null,
            'responded_at' => null,
            'resolved_at' => null,
            'assigned_to' => null,
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }

    /**
     * Indicate that the complaint is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'admin_response' => null,
            'responded_at' => null,
            'resolved_at' => null,
            'assigned_to' => null,
        ]);
    }

    /**
     * Indicate that the complaint is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'admin_response' => $this->faker->paragraph(),
            'responded_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'assigned_to' => 1,
        ]);
    }

    /**
     * Indicate that the complaint is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'admin_response' => $this->faker->paragraph(),
            'responded_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
            'resolved_at' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'assigned_to' => 1,
        ]);
    }

    /**
     * Indicate that the complaint has high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }

    /**
     * Indicate that the complaint has urgent priority.
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'urgent',
        ]);
    }
}
