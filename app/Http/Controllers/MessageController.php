<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Convo;
use Auth;
use App\User;
use carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $convos = Convo::where('user_id', $user->id)->orWhere('to_user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        // return $convos;
        return view('message.index', compact('convos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $convo = Convo::where('user_id', $user->id)->where('to_user_id', $request->to_user_id)->first();

        if(!$convo){
            $convo = new Convo;
            $convo->user_id = $user->id;
            $convo->to_user_id = $request->to_user_id;
            $convo->save();
        }

        $message = new Message;
        $message->convo_id = $convo->id;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        session()->flash('status', 'Successfully sent');
        session()->flash('type', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($convo_id)
    {
        $me = Auth::user();
        $conversation = Convo::findOrFail($convo_id);
        
        $messages = Message::where('convo_id', $convo_id)->get();

        return view('message.show', compact('conversation', 'messages', 'me'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function reply(Request $request, $convo_id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $convo = Convo::findOrFail($convo_id);

        $message = new Message;
        $message->convo_id = $convo->id;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        $convo->updated_at = date("Y-m-d H:i:s");
        $convo->save();

        session()->flash('status', 'Successfully sent');
        session()->flash('type', 'success');

        return redirect()->back();
    }
}
