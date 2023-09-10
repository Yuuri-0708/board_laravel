<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CommentScope;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id', 'user_id', 'comment'
    ];

    protected static function booted(){
        static::addGlobalScope(new CommentScope);
    }
}
