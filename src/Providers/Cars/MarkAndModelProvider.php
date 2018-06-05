<?php

namespace AvtoDev\FakerProviders\Providers\Cars;

use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * @property-read string carMarkAndModel
 * @property-read string carMark
 * @property-read string carModel
 * @property-read string carGeneration
 */
class MarkAndModelProvider extends AbstractFakerProvider
{
    /**
     * Allowed car marks and models.
     *
     * @var string[]
     */
    public static $car_marks_and_models = [
        'Acura'        => ['CL', 'CSX', 'EL', 'ILX'],
        'Aston Martin' => ['Bulldog', 'Cygnet', 'DB11', 'DB7'],
        'Audi'         => ['Q2', 'Q3', 'Q7', 'Quattro', 'R8', 'RS 3', 'S5'],
        'BMW'          => ['02 (E10)', 'X3', '1M', '2000 C/CS'],
        'Cadillac'     => ['ATS', 'ATS-V', 'Allante', 'BLS'],
        'Daewoo'       => ['Chairman', 'Damas', 'Lacetti', 'Lanos'],
        'Geely'        => ['MK', 'MK Cross', 'SC7', 'Beauty Leopard'],
        'Honda'        => ['CR-V', 'CR-X', 'Capa', 'Civic', 'Civic Type R'],
        'Hyundai'      => ['Coupe', 'Creta', 'Dynasty', 'Elantra'],
        'Infiniti'     => ['EX', 'FX', 'G', 'I'],
        'Kia'          => ['Joice', 'RIO', 'Ray', 'Sedona'],
        'LADA (ВАЗ)'   => ['Vesta', 'XRAY', '1111 Ока', '2131 (4x4)'],
        'Land Rover'   => ['Defender', 'Discovery', 'Discovery Sport', 'Freelander'],
        'Lexus'        => ['GS', 'GS F', 'GX', 'HS'],
        'Nissan'       => ['Juke', 'Kix', 'Lafesta', 'Langley'],
        'Opel'         => ['Manta', 'Meriva OPC', 'Mokka', 'Monterey'],
        'Renault'      => ['Rodeo', 'SM5', 'Safrane', 'Sandero RS'],
        'Rover'        => ['Streetwise', '100', '45', 'Metro'],
        'Skoda'        => ['Octavia', 'Octavia RS', 'Popular', 'Rapid'],
        'Toyota'       => ['Sequoia', 'Sienna', 'Sprinter Carib', 'Supra', 'iQ', 'Caldina', 'Camry (Japan market)'],
        'Volvo'        => ['Laplander', 'P1900', 'S40', 'S60 Cross Country'],
        'ИЖ'           => ['2125 "Комби"', '2126 "Ода"', '21261 "Фабула"'],
        'УАЗ'          => ['3162 Simbir', '469', '3153', 'Hunter'],
    ];

    /**
     * Allowed cars generations.
     *
     * @var string[]
     */
    public static $car_generations = [
        'I', 'II', 'III', 'IV', 'V', 'VI', 'IV',
        'I Restyling', 'II Restyling', 'III Restyling', 'IV Restyling', 'V Restyling', 'VI Restyling', 'IV Restyling'
    ];

    /**
     * Generate random car mark and model as a single string.
     *
     * @return string
     */
    public static function carMarkAndModel()
    {
        return sprintf('%s %s', $mark = static::carMark(), static::carModel($mark));
    }

    /**
     * Generate random car mark.
     *
     * @return string
     */
    public static function carMark()
    {
        return static::randomElement(\array_keys(static::$car_marks_and_models));
    }

    /**
     * Generate random car model for passed car mark.
     *
     * @param string|null $mark
     *
     * @return string
     */
    public static function carModel($mark = null)
    {
        return static::randomElement(static::$car_marks_and_models[$mark === null
            ? static::carMark()
            : $mark]);
    }

    /**
     * Generate random car generation.
     *
     * @return string
     */
    public static function carGeneration()
    {
        return static::randomElement(static::$car_generations);
    }
}
