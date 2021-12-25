<?php

namespace App\Support\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasCreator.
 *
 * @property User $creator_id
 */
trait HasCreator
{
    public static function bootHasCreator()
    {
        static::saving(function ($model) {
            $model->creator_id = $model->creator_id ?: auth()->id();
        });
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * @param User|int $user
     *
     * @return bool
     */
    public function isCreatedBy($user): bool
    {
        if ($user instanceof User) {
            $user = $user->id;
        }

        return $this->creator_id === intval($user);
    }
}
