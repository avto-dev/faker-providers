<?php

namespace AvtoDev\FakerProviders\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class AbstractTestCase extends BaseTestCase
{
    /**
     * Most important test cases repeats count.
     *
     * @var int
     */
    protected $repeats_count = 50;
}
