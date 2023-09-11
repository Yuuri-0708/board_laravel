<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadsRequest;
use App\Http\Requests\UpdateThreadsRequest;
use App\Models\Threads;
use App\Models\Comments;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $threads_titles = Threads::searchThreads($request->search)
            ->select('id', 'thread_name', 'user_id', 'status', 'show_count','created_at', 'updated_at')
            ->where('status', true)
            ->paginate(50)
            ->withQueryString(); 
        $search_word = $request->search;
        return Inertia::render('Threads/Index', [
            'threads_titles' => $threads_titles, 
            'search_word' => $search_word
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Threads/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadsRequest $request)
    {
        $user_id = Auth::id();

        $new_thread = Threads::create([
            'thread_name' => $request->thread_name, 
            'user_id' => $user_id, 
        ]);

        return to_route('threads.show', ['thread' => $new_thread->id])
        ->with([
            'message' => 'スレッドを作成しました。', 
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Threads $thread)
    {
        $thread->show_count = $thread->show_count + 1;
        $thread->save();

        DB::statement('set @row_num = 0;');
        $thread_comments = Comments::where('thread_id', $thread->id)
        ->orderBy('created_at', 'asc')
        ->selectRaw('id, @row_num := @row_num + 1 as row_num, user_id, hash_id, user_name,  comment, created_at')
        ->paginate(50)
        ->withQueryString();


        return Inertia::render('Threads/Show', [
            'thread_id' => $thread->id, 
            'thread_title' => $thread->thread_name, 
            'thread_comments' => $thread_comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Threads $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Threads $thread)
    {
        $thread->status = !($thread->status);
        $thread->save();

        return to_route('mypage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Threads $thread)
    {
        $thread->delete();

        return to_route('Mypage');
    }
}
