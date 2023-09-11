<?php

namespace App\Http\Controllers;

use App\Models\Threads;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $user_info = User::select('id', 'name','hash_id', 'email', 'created_at')
        ->where('id', $user_id)->first();

        $threads_titles = Threads::select('id', 'thread_name', 'user_id', 'status', 'show_count','created_at', 'updated_at')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString(); 

        return Inertia::render('Mypage', [
            'user_info' => $user_info, 
            'threads_titles' => $threads_titles
        ]);
    }
}
