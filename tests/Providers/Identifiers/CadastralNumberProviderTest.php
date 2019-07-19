<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider<extended>
 * @group  Eldar
 */
class CadastralNumberProviderTest extends AbstractIdentifierTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return CadastralNumberProvider::class;
    }

    /**
     * {@inheritdoc}
     */
    protected function getValidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->cadastralNumber
            : $this->faker->cadastralNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function getInvalidIdentifier(): string
    {
        return \random_int(0, 1) === 1
            ? $this->faker->invalidCadastralNumber
            : $this->faker->invalidCadastralNumber();
    }

    /**
     * {@inheritdoc}
     */
    protected function validatorRule(): string
    {
        return 'string|cadastral_number';
    }
}
