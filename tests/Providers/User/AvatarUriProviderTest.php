<?php

namespace AvtoDev\FakerProviders\Tests\Providers\User;

use AvtoDev\FakerProviders\Providers\User\AvatarUriProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;

class AvatarUriProviderTest extends AbstractProviderTestCase
{
    /**
     * Test user avatar uri method method.
     *
     * @return string
     */
    public function testUserAvatarUri()
    {
        $size = '150';
        $url  = 'https://placebeard.it/' . $size;

        $this->assertStringStartsWith(AvatarUriProvider::$avatar_url, $url);
        $this->assertContains($size, $url);
    }

    /**
     * Test user avatar uri method exception.
     *
     * @return void
     */
    public function testUserAvatarUriException()
    {
        $this->expectException(\Exception::class);
        $this->faker->userAvatarUri(new \stdClass);
    }

    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return AvatarUriProvider::class;
    }
}
