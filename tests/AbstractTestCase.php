<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Tests;

abstract class AbstractTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Most important test cases repeats count.
     *
     * @var int
     */
    protected $repeats_count = 50;
}
