<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Blog $blog): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [
            'super_admin',
            'editor',
            'user',
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blog $blog): bool
    {
        // Super Admin can update everything
        if ($user->role === 'super_admin') {
            return true;
        }

        // Editor can update everything
        if ($user->role === 'editor') {
            return true;
        }

        // User can update only their own blogs
        return $blog->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blog $blog): bool
    {
        // Super Admin can delete everything
        if ($user->role === 'super_admin') {
            return true;
        }

        // Editor can delete everything
        if ($user->role === 'editor') {
            return true;
        }

        // User can delete only their own blogs
        return $blog->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Blog $blog): bool
    {
        return $user->role === 'super_admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Blog $blog): bool
    {
        return $user->role === 'super_admin';
    }
}
