<?php

namespace AvtoDev\FakerProviders\Providers;

abstract class AbstractFakerProvider extends \Faker\Provider\Base
{
    /**
     * @var \Faker\Generator|\AvtoDev\FakerProviders\ExtendedFaker
     */
    protected $generator;
}
