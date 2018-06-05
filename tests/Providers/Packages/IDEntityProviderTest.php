<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Cars;

use AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;
use AvtoDev\IDEntity\IDEntity;
use AvtoDev\IDEntity\Types\TypedIDEntityInterface;

class IDEntityProviderTest extends AbstractProviderTestCase
{
    /**
     * Test car mark generation method.
     *
     * @return void
     */
    public function testCarMark()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            foreach (IDEntity::getSupportedTypes() as $id_type) {
                $id_entity = $this->faker->idEntity($id_type);

                $this->assertEquals($id_type, $id_entity->getType());
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
    protected function providerClass()
    {
        return IDEntityProvider::class;
    }
}
