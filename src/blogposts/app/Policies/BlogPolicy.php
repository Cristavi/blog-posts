<?php

namespace App\Policies;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return bool
     */
    public function edit(User $user, Blogs $blogs): bool
    {
        return $user->id === $blogs->user_id;
    }
}
