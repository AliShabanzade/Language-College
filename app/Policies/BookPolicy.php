<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
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
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value,
            PermissionsEnum::BOOK_INDEX->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value,
            PermissionsEnum::BOOK_SHOW->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value,
            PermissionsEnum::BOOK_STORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value,
                PermissionsEnum::BOOK_UPDATE->value,PermissionsEnum::ADMIN->value)
            || $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value,
            PermissionsEnum::BOOK_DELETE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value, PermissionsEnum::BOOK_RESTORE->value,PermissionsEnum::ADMIN->value);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::BOOK_ALL->value, PermissionsEnum::BOOK_STORE->value,PermissionsEnum::ADMIN->value);

    }

    public function addLike(User $user, Book $book)
    {
        return true;
    }

}
