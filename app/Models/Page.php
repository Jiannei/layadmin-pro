<?php

namespace App\Models;

/**
 * Class Page.
 *
 * @package namespace App\Models;
 */
class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'uri',
        'title',
        'layout',
        'view',
        'styles',
        'scripts',
        'components',

        'creator_id',
        'updater_id',
    ];

    protected $casts = [
        'styles' => 'json',
        'scripts' => 'json',
        'components' => 'json',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
