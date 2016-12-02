<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\ApiHelper;

class MessageController extends Controller
{

    /**
     * Lists all messages.
     */
    public function index()
    {
        $messages = Message::with('user')->get();

        return ApiHelper::toJson($messages);
    }

    /**
     * Lists a given message.
     */
    public function show($id)
    {
        $message = Message::with('user')->where('id', $id)->first();

        if ( ! $message) {
            return ApiHelper::toError('Message not found');
        }

        return ApiHelper::toJson($message);
    }

    /**
     * Deletes a given message.
     */
    public function delete($id)
    {
        $message = Message::find($id);

        if ( ! $message) {
            return ApiHelper::toError('Message not found');
        }

        $message->delete();

        return ApiHelper::toSuccess('Message deleted');
    }

}
