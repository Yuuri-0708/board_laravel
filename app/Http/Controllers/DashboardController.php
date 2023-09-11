<?php

namespace App\Http\Controllers;

use App\Models\Threads;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads_titles_new = Threads::select('id', 'thread_name', 'user_id', 'status','show_count', 'created_at', 'updated_at')
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5); 
        $threads_titles_popular = Threads::select('id', 'thread_name', 'user_id', 'status', 'show_count', 'created_at', 'updated_at')
            ->where('status', true)
            ->orderBy('show_count', 'desc')
            ->paginate(5); 
        return Inertia::render('Dashboard', [
            'threads_titles_new' => $threads_titles_new, 
            'threads_titles_popular' => $threads_titles_popular
        ]);
    }
}
