<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Message;

class DummyMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all created dummy conversations
        $allConversations = Conversation::all();

        foreach ($allConversations as $conversation) {
            // set the numb of messages per conversation
            $messageCount = rand(5, 15);

            // get conversation participants
            $senderId = $conversation->sender_id;
            $receiverId = $conversation->receiver_id;
            $participants = [$senderId, $receiverId];

            // run func - seeder
            for ($i = 0; $i < $messageCount; $i++) {
                $currSender = $participants[rand(0, 1)];

                Message::factory()->create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $currSender,
                ]);
            }
        }
    }
}
