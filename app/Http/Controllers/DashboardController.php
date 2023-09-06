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
        $threads_titles_new = Threads::select('id', 'thread_name', 'user_id', 'status', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get(); 
        $threads_titles_popular = Threads::select('id', 'thread_name', 'user_id', 'status', 'updated_at')
            ->orderBy('show_count', 'desc')
            ->get(); 
        return Inertia::render('Dashboard', [
            'threads_titles_new' => $threads_titles_new, 
            'threads_titles_popular' => $threads_titles_popular
        ]);
    }
}
