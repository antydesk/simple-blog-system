<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Пользователь может просматривать список постов (например, свои).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Пользователь может просматривать конкретный пост, если он его автор.
     */
    public function view(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Пользователь может создавать посты.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Пользователь может обновлять только свои посты.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Пользователь может удалять только свои посты.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Восстановление поста — по аналогии.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Удаление безвозвратно — тоже только своих.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
