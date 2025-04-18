<?php

namespace App\Http\Controllers;

use App\Models\CarListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    /**
     * Display all message related to the conversation
     */
    public function index(Conversation $conversation)
    {
        // check if user is authorized
        if ($conversation->sender_id != Auth::id() && $conversation->receiver_id != Auth::id()) {
            abort(403, 'Unauthorized!');
        }

        // get all message related to the conversation
        $messages = $conversation->messages()->with('sender')->get();

        // mark received messages as read
        $messages->each(function ($message) {
            if ($message->sender_id != Auth::id() && is_null($message->read_at)) {
                $message->markAsRead();
            }
        });

        // get car listing
        $carListingName = CarListing::where('id', $conversation->listing_id)->first()->name;

        // display/return view
        return view('conversations.show')
            ->with('conversation', $conversation)
            ->with('messages', $messages)
            ->with('carListingName', $carListingName);
    }

    /**
     * Store a newly created resource in storage - new message
     */
    public function store(Request $request, Conversation $conversation)
    {
        // check if user is authorized
        if ($conversation->sender_id != Auth::id() && $conversation->receiver_id != Auth::id()) {
            abort(403, 'Unauthorized!');
        }

        // validate form data
        $request->validate([
            'message' => 'required|string|max:100',
        ]);

        // submit message
        try {
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => Auth::id(),
                'message' => $request->input('message'),
            ]);

            // redirect user - with success msg
            return back()->with('success', 'Message send.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error submitting your message!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message): RedirectResponse
    {
        // // check if user is owner of the message or is admin user
        if($message->sender_id !== Auth::id() && Auth::user()->role !== 'admin_user') return abort(403, 'Unauthorized!');

        try {
            // delete from database
            $message->delete();

            // redirect user - with success msg           
            return back()->with('success', 'Message deleted.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error deleting the message!');
        }
    }
}
