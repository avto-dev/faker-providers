<?php

namespace AvtoDev\FakerProviders\Providers;

use Faker\Provider\Base;

abstract class AbstractFakerProvider extends Base
{
    /**
     * @var array chars to use
     */
    protected static $chars = [];

    /**
     * Replace both of numbers and chars.
     *
     * @param string $string
     *
     * @return string
     */
    public static function bothify($string = '## ??')
    {
        $string = self::replaceWildcard($string, '*', function () {
            return mt_rand(0, 1)
                ? '#'
                : '?';
        });

        return static::lexifyChars(static::numerify($string));
    }

    /**
     * Replace format with callback.
     *
     * @param string          $string
     * @param string          $wildcard
     * @param string|\Closure $callback
     *
     * @return string
     */
    protected static function replaceWildcard($string, $wildcard = '#', $callback = 'static::randomDigit')
    {
        $length = mb_strlen($string);
        $chars  = [];

        for ($i = 0; $i < $length; $i++) {
            $chars[] = mb_substr($string, $i, 1);
        }

        $chars[] = '';
        $result  = '';

        foreach ($chars as $current_char) {
            if ($current_char === $wildcard) {
                $current_char = \call_user_func($callback);
            }
            $result .= $current_char;
        }

        return $result;
    }

    /**
     * Replace strings with allowed char range.
     *
     * @param string $string
     *
     * @return string
     */
    protected static function lexifyChars($string = '????')
    {
        return self::replaceWildcard($string, '?', 'static::getChar');
    }

    /**
     * Return one char from allowed range.
     *
     * @return string
     */
    protected static function getChar()
    {
        return static::randomElement(static::$chars);
    }
}
