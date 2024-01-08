<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value,
            PermissionEnum::BOOK_INDEX->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value,
            PermissionEnum::BOOK_SHOW->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value,
            PermissionEnum::BOOK_STORE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value,
                PermissionEnum::BOOK_UPDATE->value,PermissionEnum::ADMIN->value)
            || $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value, PermissionEnum::BOOK_DELETE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value, PermissionEnum::BOOK_RESTORE->value,PermissionEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionEnum::BOOK_ALL->value, PermissionEnum::BOOK_STORE->value,PermissionEnum::ADMIN->value);

    }

    public function addLike(User $user, Book $book)
    {
        return true;
    }
}
