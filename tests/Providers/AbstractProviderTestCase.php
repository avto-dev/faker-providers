<?php

namespace AvtoDev\FakerProviders\Tests\Providers;

use AvtoDev\FakerProviders\ExtendedFaker;
use AvtoDev\FakerProviders\Tests\AbstractTestCase;
use Faker\Generator as FakerGenerator;

abstract class AbstractProviderTestCase extends AbstractTestCase
{
    /**
     * Faker instance with loaded provider.
     *
     * @var FakerGenerator|ExtendedFaker
     */
    protected $faker;

    /**
     * Get provider class name for testing.
     *
     * @return string
     */
    abstract protected function providerClass();

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->faker = new FakerGenerator;

        $provider_class = $this->providerClass();
        $this->faker->addProvider(new $provider_class($this->faker));
    }

    /**
     * Test that provider was successfully loaded.
     *
     * @return void
     */
    public function testProviderLoaded()
    {
        $loaded = \array_map('get_class', $this->faker->getProviders());

        $this->assertContains($this->providerClass(), $loaded);
    }
}
