<?php

namespace App\Models;

use App\Support\Traits\HasCreator;
use App\Support\Traits\HasUpdater;

/**
 * Class Menu.
 *
 * @package namespace App\Models;
 */
class Menu extends Model
{
    use HasCreator, HasUpdater;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'p_id',
        'title',
        'icon',
        'href',
        'open_type',
        'order',
        'creator_id',
        'updater_id',
    ];

    protected $casts = [
        'p_id' => 'integer',
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'p_id', 'id')->with('children');
    }

    public function transform()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'icon' => $this->icon,
            'type' => $this->p_id ? 1 : 0,
            'href' => $this->href,
            'openType' => $this->open_type,
            'parentId' => $this->p_id,
            'order' => $this->order,
        ];
    }
}
