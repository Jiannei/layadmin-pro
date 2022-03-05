<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;
use Rinvex\Attributes\Models\Type\Boolean;
use Rinvex\Attributes\Models\Type\Integer;
use Rinvex\Attributes\Models\Type\Varchar;

class AttributeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTypes();
    }

    protected function registerTypes(): void
    {
        // FIXME: 内存溢出
        Attribute::typeMap([
            'varchar' => Varchar::class,
            'boolean' => Boolean::class,
            'integer' => Integer::class,
        ]);
    }
}
