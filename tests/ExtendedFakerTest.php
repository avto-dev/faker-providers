<?php

namespace AvtoDev\FakerProviders\Tests;

use AvtoDev\FakerProviders\ExtendedFaker;

class ExtendedFakerTest extends AbstractTestCase
{
    /**
     * Assert that class exists.
     *
     * @return void
     */
    public function testClassExists()
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessageRegExp('~Call to private~i');

        new ExtendedFaker;
    }

    /**
     * Test class php doc.
     *
     * @return void
     */
    public function testPhpDocs()
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
