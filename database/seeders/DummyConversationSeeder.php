<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\CarListing;

class DummyConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create/get all created dummy conversations
        $conversations = Conversation::factory(50)->create();

        $conversations->each(function ($conversation) {
            // get car listings of the message receiver
            $listing = CarListing::where('user_id', $conversation->receiver_id)
                ->inRandomOrder()
                ->first();

            // add listing_id to the created dummy conversation
            if ($listing) {
                $conversation->listing_id = $listing->id;
                $conversation->save();
            } else {
                $conversation->delete();
            }
        });
    }
}
