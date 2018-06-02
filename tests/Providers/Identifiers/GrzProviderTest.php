<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider;
use AvtoDev\IDEntity\IDEntity;
use Closure;

class GrzProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return GrzProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->grzCode
            : $this->faker->grzCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->invalidGrzCode
            : $this->faker->invalidGrzCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule()
    {
        return 'string|grz_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback()
    {
        return function ($identifier) {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_GRZ)->isValid();
        };
    }
}
