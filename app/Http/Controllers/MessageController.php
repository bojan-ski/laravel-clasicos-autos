<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\CarListing;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display all message related to the conversation
     */
    public function index(Conversation $conversation): View
    {
        // check if user is authorized
        $this->authorize('view', [Conversation::class, $conversation]);

        // get all message related to the conversation
        $messages = $conversation->messages()->with('sender')->get();

        // mark received messages as read
        $messages->each(function ($message) {
            if ($message->sender_id != Auth::id() && is_null($message->read_at) && Auth::user()->role !== 'admin_user') {
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
    public function store(Request $request, Conversation $conversation): RedirectResponse
    {
        // check if user is authorized
        $this->authorize('create', [Message::class, $conversation]);

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
    public function deleteMessage(Message $message): RedirectResponse
    {
        // check if user is authorized
        $this->authorize('delete', [Message::class, $message]);

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

    /**
     * Check for new messages
     */
    public function newMessage(): JsonResponse|RedirectResponse
    {
        // redirect user if in browser types the url
        // if (!request()->ajax()) {
        //     return redirect()->route('home.index');
        // }

        // run func 
        $count = Message::whereHas('conversation', function ($query) {
            $query->where('receiver_id', Auth::id())
                ->orWhere('sender_id', Auth::id());
        })
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }
}
