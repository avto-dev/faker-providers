<?php

namespace AvtoDev\FakerProviders\Tests\Providers\Cars;

use AvtoDev\FakerProviders\Providers\Cars\MarkAndModelProvider;
use AvtoDev\FakerProviders\Tests\Providers\AbstractProviderTestCase;

class MarkAndModelProviderTest extends AbstractProviderTestCase
{
    /**
     * Test car mark generation method.
     *
     * @return void
     */
    public function testCarMark()
    {
        $valid = \array_keys(MarkAndModelProvider::$car_marks_and_models);

        for ($i = 0; $i < $this->repeats_count; $i++) {
            $this->assertContains($this->faker->carMark(), $valid);
            $this->assertContains($this->faker->carMark, $valid);
        }
    }

    /**
     * Test car model generation method.
     *
     * @return void
     */
    public function testCarModel()
    {
        $summary = [];

        foreach (MarkAndModelProvider::$car_marks_and_models as $car_marks_and_model) {
            foreach ($car_marks_and_model as $model) {
                $summary[] = $model;
            }
        }

        for ($i = 0; $i < $this->repeats_count; $i++) {
            $this->assertContains(
                $this->faker->carModel($mark = $this->faker->carMark),
                MarkAndModelProvider::$car_marks_and_models[$mark]
            );
            $this->assertContains($this->faker->carModel, $summary);
        }
    }

    /**
     * Test mark + model generation method.
     *
     * @return void
     */
    public function testCarMarkAndModel()
    {
        $models = [];

        foreach (MarkAndModelProvider::$car_marks_and_models as $car_marks_and_model) {
            foreach ($car_marks_and_model as $model) {
                $models[] = $model;
            }
        }

        $marks = \array_keys(MarkAndModelProvider::$car_marks_and_models);

        for ($i = 0; $i < $this->repeats_count; $i++) {
            $car_and_model = $this->faker->carMarkAndModel;

            $mark_found  = false;
            $model_found = false;

            foreach ($marks as $mark) {
                if (\mb_strpos($car_and_model, $mark) !== false) {
                    $mark_found = true;

                    break;
                }
            }

            foreach ($models as $model) {
                if (\mb_strpos($car_and_model, $model) !== false) {
                    $model_found = true;

                    break;
                }
            }

            $this->assertTrue($mark_found);
            $this->assertTrue($model_found);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function providerClass()
    {
        return MarkAndModelProvider::class;
    }
}
