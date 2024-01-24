<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\Packages;

use AvtoDev\IDEntity\IDEntity;
use AvtoDev\IDEntity\Types\TypedIDEntityInterface;
use AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;

/**
 * @covers \AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider
 */
class IDEntityProviderTest extends AbstractProviderTestCase
{
    /**
     * Test idEntity generation method.
     *
     * @return void
     */
    public function testIdEntity(): void
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            foreach (IDEntity::getSupportedTypes() as $id_type) {
                $id_entity = $this->faker->idEntity($id_type);

                $this->assertSame($id_type, $id_entity->getType());
                $this->assertTrue($id_entity->isValid());
            }

            $random_id_entity = $this->faker->idEntity;
            $this->assertInstanceOf(TypedIDEntityInterface::class, $random_id_entity);
            $this->assertTrue($random_id_entity->isValid());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return IDEntityProvider::class;
    }
}
