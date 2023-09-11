<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CommentScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sql = 'select comments.id as id
        , users.id as user_id
        , users.hash_id as hash_id
        , users.name as user_name
        , comments.thread_id as thread_id
        , comments.comment
        , comments.created_at
        , comments.updated_at
        from comments
        left join users on comments.user_id = users.id
        ';
        $builder->fromSub($sql, 'comments_scope');
    }
}
