<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    /**
     * Create a new LikeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeIt(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => Auth::id(),
        ]);

        broadcast(new LikeEvent($reply->id, 1))->toOthers();
    }

    public function unLikeIt(Reply $reply)
    {
        $reply->like()->where(['user_id' => Auth::id()])->first()->delete();

        broadcast(new LikeEvent($reply->id, 0))->toOthers();
    }
}
