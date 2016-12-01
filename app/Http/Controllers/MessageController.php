<?php

namespace App\Http\Controllers;

use App\Message;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::with('user')->get();

        return response()->json($messages);
    }

    public function show($id)
    {
        $message = Message::with('user')->where('id', $id)->first();

        return response()->json($message);
    }
    
    public function update(Request $request, $id)
    {
        $message = Message::find($id);

        $message->message = $request->input('message');
        $message->save();

        return response()->json($message);
    }
    
    public function delete($id)
    {
        $message = Message::find($id);

        $message->delete();

        return response()->json($message);
    }

}
