<?php

namespace AvtoDev\FakerProviders\Tests\Traits;

use Illuminate\Contracts\Console\Kernel;
use AvtoDev\IDEntity\IDEntitiesServiceProvider;
use AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider;
use AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider;

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

        // $app->useStoragePath(...);
        // $app->loadEnvironmentFrom(...);

        $app->make(Kernel::class)->bootstrap();

        $app->register(ExtendedValidatorServiceProvider::class);
        $app->register(IDEntitiesServiceProvider::class);
        $app->register(ServiceProvider::class);

        return $app;
    }
}
