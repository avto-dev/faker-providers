<?php

namespace AvtoDev\FakerProviders\Frameworks\Laravel;

use Faker\Generator as FakerGenerator;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Get config root key name.
     *
     * @return string
     */
    public static function getConfigRootKeyName()
    {
        return basename(static::getConfigPath(), '.php');
    }

    /**
     * Returns path to the configuration file.
     *
     * @return string
     */
    public static function getConfigPath()
    {
        return __DIR__ . '/config/faker.php';
    }

    /**
     * @param FakerGenerator $generator
     *
     * @return void
     */
    public function boot(FakerGenerator $generator)
    {
        foreach ($this->fakerProviders() as $provider_class) {
            $generator->addProvider(new $provider_class($generator));
        }
    }

    /**
     * Register any services.
     *
     * @return void
     */
    public function register()
    {
        $this->initializeConfigs();
    }

    /**
     * Initialize configs.
     *
     * @return void
     */
    protected function initializeConfigs()
    {
        $this->mergeConfigFrom(static::getConfigPath(), static::getConfigRootKeyName());

        $this->publishes([
            realpath(static::getConfigPath()) => config_path(basename(static::getConfigPath())),
        ], 'config');
    }

    /**
     * Get an array of faker providers for registration.
     *
     * @return string[]
     */
    protected function fakerProviders()
    {
        return \array_unique(\array_merge($this->packageProviders(), $this->userDefinedProviders()));
    }

    /**
     * Get an array of user-defined faker providers classes.
     *
     * @return string[]
     */
    protected function userDefinedProviders()
    {
        /** @var ConfigRepository $config */
        $config = $this->app->make('config');

        return (array) $config->get(sprintf('%s.providers', static::getConfigRootKeyName()));
    }

    /**
     * Get an array of package faker providers classes.
     *
     * @return string[]
     */
    protected function packageProviders()
    {
        return [
            \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider::class,

            \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\StsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider::class,

            \AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider::class,

            \AvtoDev\FakerProviders\Providers\User\AvatarUriProvider::class,
        ];
    }
}
