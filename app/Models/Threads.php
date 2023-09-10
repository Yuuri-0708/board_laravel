<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{
    use HasFactory;

    public function scopeSearchThreads($query, $input = null){
        if(!empty($input)){
            if(Threads::where('thread_name', 'like', '%' . $input . '%')->exists()){
                return $query->where('thread_name', 'like', '%' . $input . '%');
            }
        }
    }

    protected $fillable = [
        'thread_name', 
        'user_id',
        'thread_first_seq', 
        'status'
    ];
}
