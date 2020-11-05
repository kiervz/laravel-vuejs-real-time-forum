<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user_questions = QuestionResource::collection($user->questions);
        return response()->json([
            'user' => $user,
            'user_questions' => $user_questions,
        ]);
        // return $get_user;
    }
}
