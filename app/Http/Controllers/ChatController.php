<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Method to display the chat page
    public function index($userId)
    {
        // Get the user to chat with
        $user = User::findOrFail($userId);
        
        // Get all users except the logged-in user
        $users = User::where('id', '!=', auth()->id())->get();
    
        // Get messages between the logged-in user and the user being chatted with
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })->get();
    
        return view('chat.index', compact('userId', 'users', 'messages', 'user'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Check if the user is trying to send a message to themselves
        if ($request->receiver_id == auth()->id()) {
            return redirect()->back()->with('error', 'You cannot send a message to yourself.');
        }

        // Save the message to the database
        try {
            Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message. Please try again.');
        }
    
        // Redirect back to the chat page with a success message
        return redirect()->route('chat.index', $request->receiver_id)->with('success', 'Message sent successfully!');
    }

    public function getMessages($userId)
    {
        $messages = Message::with(['sender', 'receiver']) // Eager load sender and receiver
            ->where(function($query) use ($userId) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $userId);
            })->orWhere(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', auth()->id());
            })->get();
        
        return response()->json($messages);
    }
}