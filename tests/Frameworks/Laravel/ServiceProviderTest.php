<?php

namespace AvtoDev\FakerProviders\Tests\Frameworks\Laravel;

use Faker\Generator as FakerGenerator;
use AvtoDev\FakerProviders\Frameworks\Laravel\ServiceProvider;
use AvtoDev\FakerProviders\Tests\Traits\CreatesLaravelApplicationTrait;
use Illuminate\Foundation\Testing\TestCase as IlluminateTestCase;

class ServiceProviderTest extends IlluminateTestCase
{
    use CreatesLaravelApplicationTrait;

    /**
     * @var FakerGenerator
     */
    protected $faker;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->faker = $this->app->make(FakerGenerator::class);
    }

    /**
     * Test that faker providers was successfully registered.
     *
     * @return void
     */
    public function testFakerProvidersRegistered()
    {
        $providers = [
            \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\StsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider::class,
        ];

        foreach ($providers as $provider_class) {
            $this->assertFakerProviderLoaded($provider_class);
        }
    }

    /**
     * Test that faker providers, declared in config file, was successfully registered.
     *
     * @return void
     */
    public function testConfigFakerProvidersRegistered()
    {
        $providers = [
            \Faker\Provider\ru_RU\Address::class,
        ];

        foreach ($providers as $provider_class) {
            $this->assertFakerProviderLoaded($provider_class);
        }
    }

    /**
     * Assert that passed faker provider class was loaded by faker instance.
     *
     * @param string $provider_class
     *
     * @return void
     */
    protected function assertFakerProviderLoaded($provider_class)
    {
        $loaded_providers = \array_map('get_class', $this->faker->getProviders());

        $this->assertContains($provider_class, $loaded_providers);
    }
}
