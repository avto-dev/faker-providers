<?php

namespace AvtoDev\FakerProviders\Tests;

use LogicException;
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
        $this->expectException(LogicException::class);
        $this->expectExceptionMessageRegExp('~just for IDE~i');

        new ExtendedFaker();
    }
}
