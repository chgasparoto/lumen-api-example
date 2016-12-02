<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Http\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $rules;

    public function __construct()
    {
        $this->rules = [
          'message' => 'required|string|max:140',
          'user_id' => [
            'required',
            'integer',
            Rule::exists('users', 'id')
          ]
        ];
    }

    /**
     * Shows all users.
     */
    public function index()
    {
        $users = User::all();

        return ApiHelper::toJson($users);
    }

    /**
     * Shows a given user.
     */
    public function show($id)
    {
        $user = User::find($id);

        if ( ! $user) {
            return ApiHelper::toError('User not found');
        }

        return ApiHelper::toJson($user);
    }

    /**
     * Creates a new message for the given user.
     */
    public function createMessage(Request $request)
    {
        $validator = \Validator::make($request->input(), $this->rules);

        if ($validator->fails()) {
            return ApiHelper::toError($validator->messages());
        }

        $message = Message::create($request->all());

        return ApiHelper::toJson($message, 'Message created');
    }

    /**
     * Updates a given message
     */
    public function updateMessage(Request $request, $id, $message_id)
    {
        $validator = \Validator::make($request->input(), $this->rules);

        if ($validator->fails()) {
            return ApiHelper::toError($validator->messages());
        }

        $message = Message::find($message_id);

        if ( ! $message) {
            return ApiHelper::toError('Message not found for this user');
        }

        if ($message->user_id != $request->input('user_id')) {
            return ApiHelper::toError('You do not have permission to edit this message', 'error', 403);
        }

        $message->message = $request->input('message');
        $message->save();

        return ApiHelper::toJson($message, 'Message updated');

    }

    /**
     * Gets the user messages.
     */
    public function userMessages($id)
    {
        $messages = Message::all()->where('user_id', $id);

        if ( ! $messages) {
            return ApiHelper::toError('Message not found for this user');
        }

        return ApiHelper::toJson($messages);
    }

}
