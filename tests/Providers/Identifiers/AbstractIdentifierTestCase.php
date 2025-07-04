<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Factory as ValidationFactory;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;
use AvtoDev\FakerProviders\Tests\Traits\CreatesLaravelApplicationTrait;

abstract class AbstractIdentifierTestCase extends AbstractProviderTestCase
{
    use CreatesLaravelApplicationTrait;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var ValidationFactory
     */
    protected $validation_factory;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app = $this->createApplication();

        $this->validation_factory = $this->app->make('validator');
    }

    protected function tearDown(): void
    {
        unset($this->app, $this->validation_factory);

        parent::tearDown();
    }

    /**
     * Test identifier using laravel validator and closure.
     *
     * @return void
     */
    public function testValidUsingValidator(): void
    {
        $rule         = $this->validatorRule();
        $callback     = $this->validationCallback();
        $use_callback = $callback instanceof Closure;

        for ($i = 0; $i < $this->repeats_count * 10; $i++) {
            $identifier = $this->getValidIdentifier();
            $validator  = $this->validation_factory->make(['value' => $identifier], ['value' => $rule]);

            $this->assertTrue($validator->passes(), "Identifier [{$identifier}] is NOT invalid");

            if ($use_callback === true) {
                $this->assertTrue($callback($identifier), "Identifier [{$identifier}] failed callback checking");
            }
        }
    }

    /**
     * Test INVALID identifier using laravel validator and closure.
     *
     * @return void
     */
    public function testInvalidUsingValidator(): void
    {
        $rule         = $this->validatorRule();
        $callback     = $this->validationCallback();
        $use_callback = $callback instanceof Closure;

        for ($i = 0; $i < $this->repeats_count * 5; $i++) {
            $identifier = $this->getInvalidIdentifier();
            $validator  = $this->validation_factory->make(['value' => $identifier], ['value' => $rule]);

            $this->assertFalse($validator->passes(), "Identifier [{$identifier}] is valid (but should not)");

            if ($use_callback === true) {
                $this->assertFalse($callback($identifier), "Identifier [{$identifier}] failed callback checking");
            }
        }
    }

    /**
     * Get valid identifier value.
     *
     * @return string
     */
    abstract protected function getValidIdentifier(): string;

    /**
     * Get INVALID identifier value.
     *
     * @return string
     */
    abstract protected function getInvalidIdentifier(): string;

    /**
     * Get rule for validator checking.
     *
     * @return string
     */
    protected function validatorRule(): string
    {
        return 'string|required';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure|null
     */
    protected function validationCallback(): ?Closure
    {
        return null;
    }
}
