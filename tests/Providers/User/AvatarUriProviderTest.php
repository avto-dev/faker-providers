<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests\Providers\User;

use AvtoDev\FakerProviders\Providers\User\AvatarUriProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;

/**
 * @covers \AvtoDev\FakerProviders\Providers\User\AvatarUriProvider<extended>
 */
class AvatarUriProviderTest extends AbstractProviderTestCase
{
    /**
     * Test user avatar uri method method.
     *
     * @return void
     */
    public function testUserAvatarUri(): void
    {
        $stack = [];

        foreach (['foo', 'foo bar', '', new \stdClass, [], [1, 2], null] as $mixed_value) {
            $width  = \random_int(100, 200);
            $height = \random_int(100, 200);

            $uri = $this->faker->userAvatarUri($mixed_value, $width, $height);

            $this->assertStringStartsWith('https', $uri);
            $this->assertStringContainsString((string) $width, $uri);
            $this->assertStringContainsString((string) $height, $uri);
            $this->assertNotContains($uri, $stack); // Make sure that result is unique for each passed object
            $stack[] = $uri;
        }

        // Two calls returns same result
        $this->assertSame(
            $this->faker->userAvatarUri($same_value = 'foo bar baz'),
            $this->faker->userAvatarUri($same_value)
        );
    }

    /**
     * Test working with negative width or height.
     *
     * @return void
     */
    public function testNegativeWidthOrHeight(): void
    {
        foreach ([-10, -1000, \random_int(-200, -100)] as $value) {
            $uri = $this->faker->userAvatarUri(null, $value, $value);

            $positive = (int) abs($value);
            $this->assertNotRegExp("~\-{$positive}~", $uri);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function providerClass(): string
    {
        return AvatarUriProvider::class;
    }
}
