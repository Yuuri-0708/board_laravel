<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentsRequest $request)
    {
        $user_id = Auth::id();


        Comments::create([
            'thread_id' => $request->thread_id, 
            'user_id' => $user_id,
            'comment' => $request->comment
        ]);

        return to_route('threads.show', ['thread' => $request->thread_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
