<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Shows all users.
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Shows a given user.
     */
    public function show($userId)
    {
        $user = User::find($userId);

        return response()->json($user);
    }

    /**
     * Creates a new message for the given user.
     */
    public function createMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => $request->input('user_id'),
            'message' => $request->input('message')
        ]);

        return response()->json($message);
    }

    /**
     * Gets the user messages.
     */
    public function userMessages($userId)
    {
        $message = Message::all()->where('user_id', $userId);

        return response()->json($message);
    }

}
