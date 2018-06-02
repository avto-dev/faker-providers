<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider;
use AvtoDev\IDEntity\IDEntity;
use Closure;

class PtsProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return PtsProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->ptsCode
            : $this->faker->ptsCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier()
    {
        return mt_rand(0, 1) === 1
            ? $this->faker->invalidPtsCode
            : $this->faker->invalidPtsCode();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule()
    {
        return 'string|pts_code';
    }

    /**
     * Get custom validation callback.
     *
     * @return Closure
     */
    protected function validationCallback()
    {
        return function ($identifier) {
            return IDEntity::make($identifier, IDEntity::ID_TYPE_PTS)->isValid();
        };
    }
}
