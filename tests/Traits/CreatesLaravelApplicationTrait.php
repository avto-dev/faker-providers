<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Traits;

use Illuminate\Contracts\Console\Kernel;
use AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider;
use AvtoDev\IDEntity\ServiceProvider as IDEntitiesServiceProvider;
use AvtoDev\ExtendedLaravelValidator\ServiceProvider as ExtendedValidatorServiceProvider;

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

        $app->register(ExtendedValidatorServiceProvider::class);
        $app->register(IDEntitiesServiceProvider::class);
        $app->register(ServiceProvider::class);

        return $app;
    }
}
