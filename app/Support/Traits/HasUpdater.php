<?php

namespace App\Support\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasUpdater.
 *
 * @property User $updater_id
 */
trait HasUpdater
{
    public static function bootHasUpdater()
    {
        static::saving(function ($model) {
            $model->updater_id = $model->updater_id ?: auth()->id();
        });
    }

    /**
     * @return BelongsTo
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updater_id');
    }

    /**
     * @param User|int $user
     *
     * @return bool
     */
    public function isUpdatedBy($user): bool
    {
        if ($user instanceof User) {
            $user = $user->id;
        }

        return $this->updater_id === (int)$user;
    }
}