<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadsRequest;
use App\Http\Requests\UpdateThreadsRequest;
use App\Models\Threads;
use App\Models\Comments;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads_titles = Threads::select('id', 'thread_name', 'user_id', 'status', 'updated_at')->get(); 
        return Inertia::render('Threads/Index', [
            'threads_titles' => $threads_titles
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
        DB::beginTransaction();
        $user_id = Auth::id();

        try{
            Threads::create([
                'thread_name' => $request->thread_name, 
                'user_id' => $user_id, 
                'user_name' => $request->user_name
            ]);

            Comments::create([
                'thread_id' => 1, 
                'user_id' => $user_id, 
                'comment' => $request->comment
            ]);

            DB::commit();
    
            return to_route('dashboard');
        } catch(\Exception $e){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Threads $threads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Threads $threads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadsRequest $request, Threads $threads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Threads $threads)
    {
        //
    }
}
