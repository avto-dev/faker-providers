<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Identifiers;

use AvtoDev\FakerProviders\Providers\Identifiers\InnAndKppProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;

/**
 * @coversDefaultClass \AvtoDev\FakerProviders\Providers\Identifiers\InnAndKppProvider
 */
class InnAndKppProviderTest extends AbstractProviderTestCase
{
    /**
     * Test inn code generation method.
     *
     * @covers ::innCode()
     * @covers ::generateInnCode()
     * @covers ::checksum()
     *
     * @return void
     */
    public function testInnCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $innCode = $this->faker->innCode();
            $this->assertTrue($this->isValidInn($innCode));
        }
    }

    /**
     * Test valid inn code generation method with different lengths.
     *
     * @covers ::validInnCode()
     *
     * @return void
     */
    public function testValidInnCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $innCode = $this->faker->validInnCode();
            $this->assertTrue($this->isValidInn($innCode));
        }
    }

    /**
     * Test short inn code generation method.
     *
     * @covers ::shortInnCode()
     *
     * @return void
     */
    public function testShortInnCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $innCode = $this->faker->shortInnCode();
            $this->assertTrue($this->isValidInn($innCode));
            $this->assertEquals(10, \mb_strlen($innCode));
        }
    }

    /**
     * Test long inn code generation method.
     *
     * @covers ::longInnCode()
     *
     * @return void
     */
    public function testLongInnCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $innCode = $this->faker->longInnCode();
            $this->assertTrue($this->isValidInn($innCode));
            $this->assertEquals(12, \mb_strlen($innCode));
        }
    }

    /**
     * Test invalid inn code generation method.
     *
     * @covers ::invalidInnCode()
     *
     * @return void
     */
    public function testInvalidInnCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $innCode = $this->faker->invalidInnCode();
            $this->assertFalse($this->isValidInn($innCode));
        }
    }

    /**
     * Test kpp code generation method.
     *
     * @covers ::kppCode()
     * @covers ::validKppCode()
     *
     * @return void
     */
    public function testKppCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $kppCode = $this->faker->kppCode();
            $this->assertTrue($this->isValidKpp($kppCode));
        }
    }

    /**
     * Test invalid kpp code generation method.
     *
     * @covers ::invalidKppCode()
     *
     * @return void
     */
    public function testInvalidKppCode()
    {
        for ($i = 0; $i < $this->repeats_count; $i++) {
            $kppCode = $this->faker->invalidKppCode();
            $this->assertFalse($this->isValidKpp($kppCode));
        }
    }

    /**
     * Checks on valid INN.
     *
     * @param string $inn
     *
     * @return bool
     */
    protected function isValidInn($inn)
    {
        $innLength = \mb_strlen($inn);
        switch ($innLength) {
            case 10:
                $checksum = $this->checksum($inn);

                return $checksum === (int) \mb_substr($inn, -1);
                break;
            case 12:
                $inn11 = $this->checksum(\mb_substr($inn, 0, -1));
                $inn12 = $this->checksum($inn);

                return $inn11 === (int) $inn[10] && $inn12 === (int) $inn[11];
                break;
        }

        return false;
    }

    /**
     * Checks on valid KPP.
     *
     * @param string $kpp
     *
     * @return bool
     */
    protected function isValidKpp($kpp)
    {
        return (bool) preg_match('/^\d{4}[0-9A-Z]{2}\d{3}$/', $kpp);
    }

    /**
     * Calculate the checksum of INN.
     *
     * @param string $inn
     *
     * @return int
     */
    protected function checksum($inn)
    {
        $coefficients     = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8];
        $innLength        = \mb_strlen($inn);
        $needCoefficients = array_slice($coefficients, 12 - $innLength);
        $sum              = 0;
        foreach ($needCoefficients as $i => $v) {
            $sum += (int) \mb_substr($inn, $i, 1) * $v;
        }

        return ($sum % 11) % 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return InnAndKppProvider::class;
    }
}
