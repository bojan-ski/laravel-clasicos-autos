<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Conversation;
use App\Models\CarListing;

class ConversationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display all user conversations
     */
    public function index(): View
    {
        if (Auth::user()->role === 'admin_user') {
            // get all conversations from db
            $conversations = Conversation::latest()->paginate(12);

            // display/return view
            return view('conversations.index')->with('conversations', $conversations);
        } else {
            // get all app_user conversations from db
            $conversations = Conversation::where('sender_id', Auth::id())
                ->orWhere('receiver_id', Auth::id())
                ->latest()
                ->paginate(12);

            // display/return view
            return view('conversations.index')->with('conversations', $conversations);
        }
    }

    /**
     * Display conversation thread - message page
     */
    public function conversationThread(CarListing $listing, int $receiverId): RedirectResponse
    {
        // check if user is not admin user
        $this->authorize('create', Conversation::class);

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

        // redirect user - MessageController index method
        return redirect()->route('conversations.show', $conversation);
    }
}
