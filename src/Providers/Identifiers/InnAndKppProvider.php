<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\Identifiers;

use Faker\Provider\Miscellaneous;
use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * Class InnAndKppProvider.
 *
 * @link <https://bit.ly/1CGkpwg> Идентификационный номер налогоплательщика.
 */
class InnAndKppProvider extends AbstractFakerProvider
{
    /**
     * White-list chars that can be used in KPP code.
     *
     * @var string[]
     */
    protected static $chars = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K',
        'L', 'M', 'N', 'P', 'R', 'S', 'T', 'U', 'V', 'W',
        'X', 'Y', 'Z',
    ];

    /**
     * List of coefficients.
     *
     * Checksum calculation with the following weighting factors.
     *
     * @var int[]
     */
    protected static $coefficients = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8];

    /**
     * List of possible lengths.
     *
     * @var int[]
     */
    protected static $possibleLengths = [10, 12];

    /**
     * Generate INN code.
     *
     * @return string
     */
    public function innCode()
    {
        return $this->generateInnCode();
    }

    /**
     * Generate short INN code.
     *
     * @return string
     */
    public function shortInnCode()
    {
        return $this->generateInnCode(10);
    }

    /**
     * Generate long INN code.
     *
     * @return string
     */
    public function longInnCode()
    {
        return $this->generateInnCode(12);
    }

    /**
     * Generate valid INN code.
     *
     * @return string
     */
    public function validInnCode()
    {
        return $this->generateInnCode();
    }

    /**
     * Generate invalid INN code.
     *
     * @return string
     */
    public function invalidInnCode()
    {
        if (Miscellaneous::boolean()) {
            $code = $this->innCode();
            //Decreases the last digit of the code by 1
            $lastLetter = \mb_substr($code, -1);
            $code       = \mb_substr($code, 0, -1) . \abs((int) $lastLetter - 1);
        } else {
            //Gives the wrong length code
            $code = \mb_substr($this->innCode(), 0, 9);
        }

        return $code;
    }

    /**
     * Generate KPP code.
     *
     * @return string
     */
    public function kppCode()
    {
        return $this->validKppCode();
    }

    /**
     * Generate valid KPP code.
     *
     * @return string
     */
    public function validKppCode()
    {
        return static::toUpper(static::bothify('####??###'));
    }

    /**
     * Generate invalid KPP code.
     *
     * @return string
     */
    public function invalidKppCode()
    {
        if (Miscellaneous::boolean()) {
            $code = static::toLower(static::bothify('#######??'));
        } else {
            $code = \mb_substr($this->kppCode(), 0, 8);
        }

        return $code;
    }

    /**
     * Generate INN code.
     *
     * @param int $length
     *
     * @return string
     */
    protected function generateInnCode($length = null)
    {
        $newInnCode = '';
        $length     = $length === null
            ? static::randomElement(self::$possibleLengths)
            : $length;

        $inn = static::numerify('%#########');
        switch ($length) {
            case 10:
                $lastValue  = $this->checksum($inn, 2);
                $newInnCode = \mb_substr($inn, 0, -1) . $lastValue;
                break;
            case 12:
                $inn11      = $this->checksum($inn, 1);
                $inn12      = $this->checksum($inn . $inn11);
                $newInnCode = $inn . $inn11 . $inn12;
                break;
        }

        return $newInnCode;
    }

    /**
     * Calculate the checksum of INN.
     *
     * @param string $inn
     * @param int    $start
     *
     * @return int
     */
    protected function checksum($inn, $start = 0)
    {
        $sum          = 0;
        $coefficients = \array_slice(self::$coefficients, $start);
        foreach ($coefficients as $i => $v) {
            $sum += (int) \mb_substr($inn, $i, 1) * $v;
        }

        return ($sum % 11) % 10;
    }
}
