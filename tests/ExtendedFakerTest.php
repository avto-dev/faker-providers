<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests;

use AvtoDev\FakerProviders\ExtendedFaker;

/**
 * @covers \AvtoDev\FakerProviders\ExtendedFaker
 */
class ExtendedFakerTest extends AbstractTestCase
{
    /**
     * Assert that class constructor thrown an exception.
     *
     * @return void
     */
    public function testConstructorThrownException(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessageRegExp('~just for IDE~i');

        new ExtendedFaker;
    }

    /**
     * Test class php doc.
     *
     * @return void
     */
    public function testPhpDocs(): void
    {
        $mixins = [
            \AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider::class,

            \AvtoDev\FakerProviders\Providers\Identifiers\BodyProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\ChassisProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\DriverLicenseNumberProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\GrzProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\PtsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\StsProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\VinProvider::class,

            \AvtoDev\FakerProviders\Providers\Packages\IDEntityProvider::class,
            \AvtoDev\FakerProviders\Providers\User\AvatarUriProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\InnAndKppProvider::class,
            \AvtoDev\FakerProviders\Providers\Identifiers\CadastralNumberProvider::class,
        ];

        $class_content = \file_get_contents($path = __DIR__ . '/../src/ExtendedFaker.php');

        foreach ($mixins as $mixin) {
            $this->assertRegExp(
                sprintf('~\@mixin.+%s$~m', \preg_quote($mixin, '/')),
                $class_content,
                "Mixin [{$mixin}] does not found in [{$path}]"
            );
        }
    }
}
