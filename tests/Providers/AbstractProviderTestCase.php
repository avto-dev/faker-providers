<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers;

use Faker\Generator as FakerGenerator;
use AvtoDev\FakerProviders\ExtendedFaker;
use AvtoDev\FakerProviders\Tests\AbstractTestCase;

abstract class AbstractProviderTestCase extends AbstractTestCase
{
    /**
     * Faker instance with loaded provider.
     *
     * @var FakerGenerator|ExtendedFaker
     */
    protected $faker;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
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
    public function testProviderLoaded(): void
    {
        $loaded = \array_map('get_class', $this->faker->getProviders());

        $this->assertContains($this->providerClass(), $loaded);
    }

    /**
     * Get provider class name for testing.
     *
     * @return string
     */
    abstract protected function providerClass(): string;
}
