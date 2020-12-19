<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\SendMessage;
use App\Message;

class MessageController extends Controller
{
    public function insert(Request $request)
    {

        $message = Message::create([
          'channel_id' => $request->input('channel_id'),
          'user_id' => Auth::id(),
          'content' => $request->input('content')
        ]);
        return event(new SendMessage($message));
    }
    public function select(Request $request)
    {
        return Message::where('channel_id', $request->input('channel_id'))->get();
    }
}
