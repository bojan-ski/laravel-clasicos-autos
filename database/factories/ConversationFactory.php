<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // create conversation participants
        do {
            $senderId = $this->faker->numberBetween(2, 30);
            $receiverId = $this->faker->numberBetween(2, 30);
        } while ($senderId === $receiverId);

        // run func - factory
        return [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'listing_id' => $this->faker->numberBetween(1, 300),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
