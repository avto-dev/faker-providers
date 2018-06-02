<?php

namespace AvtoDev\FakerProviders\Tests\Traits;

use AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider;
use AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider;
use AvtoDev\IDEntity\IDEntitiesServiceProvider;
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

        // $app->useStoragePath(...);
        // $app->loadEnvironmentFrom(...);

        $app->make(Kernel::class)->bootstrap();

        $app->register(ExtendedValidatorServiceProvider::class);
        $app->register(IDEntitiesServiceProvider::class);
        $app->register(ServiceProvider::class);

        return $app;
    }
}
