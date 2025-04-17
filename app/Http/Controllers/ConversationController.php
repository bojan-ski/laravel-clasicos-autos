<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\CarListing;

class ConversationController extends Controller
{
    /**
     * Display all user conversations
     */
    public function index()
    {
        // get all conversations from db
        $conversations = Conversation::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->latest()
            ->paginate(12);

        // display/return view
        return view('conversations.index')->with('conversations', $conversations);
    }

    /**
     * Display conversation thread - message page
     */
    public function conversationThread(CarListing $listing, int $receiverId)
    {
        // check if sender and receiver are not the same user
        if (Auth::id() == $receiverId) {
            return back()->with('error', 'You cannot message yourself!');
        }

        // check if existing conversation
        $existingConversation = Conversation::where(function ($query) use ($receiverId, $listing) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId)
                ->where('listing_id', $listing->id);
        })
            ->orWhere(function ($query) use ($receiverId, $listing) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', Auth::id())
                    ->where('listing_id', $listing->id);
            })            
            ->first();

        if ($existingConversation) {
            // if existing conversation
            $conversation = $existingConversation;
        } else {
            // if not existing conversation create new conversation
            $conversation = Conversation::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $receiverId,
                'listing_id' => $listing->id,
            ]);
        }
        
        // redirect user - MessageController
        return redirect()->route('conversations.show', $conversation);
    }
}
