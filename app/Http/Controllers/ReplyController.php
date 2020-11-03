<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\ReplyResource;
use App\Notifications\NewReplyNotification;

class ReplyController extends Controller
{
    
    /**
     * Create a new ReplyController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        
        if ($reply->user_id !== $question->user_id) {
            $user->notify(new NewReplyNotification($reply));
        }
        return response()->json([
            'reply' => new ReplyResource($reply),
            'message' => 'Reply successfully created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());

        return response()->json([ 
            'message' => 'Reply successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $user = $question->user;
        $user->notifications()
        ->whereJsonContains('data', ['reply_id' => $reply->id])
        ->first()
        ->delete();

        $reply->delete();

        return response()->json([
            'message' => 'Reply successfully deleted.'
        ]);
    }
}
