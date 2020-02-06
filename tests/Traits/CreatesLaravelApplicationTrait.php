<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Traits;

use Illuminate\Contracts\Console\Kernel;

trait CreatesLaravelApplicationTrait
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = require __DIR__ . '/../../vendor/laravel/laravel/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $app->register(\AvtoDev\ExtendedLaravelValidator\ServiceProvider::class);
        $app->register(\AvtoDev\StaticReferences\ServiceProvider::class);
        $app->register(\AvtoDev\IDEntity\ServiceProvider::class);
        $app->register(\AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider::class);

        return $app;
    }
}
