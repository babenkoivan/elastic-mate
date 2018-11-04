<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\ScaledFloatNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class ScaledFloatNumericPropertyTest extends TestCase
{
    public function test_scaled_float_numeric_property_has_correct_default_values(): void
    {
        $property = new ScaledFloatNumericProperty('foo');

        $this->assertSame(
            [
                'type' => 'scaled_float',
                'coerce' => true,
                'boost' => 1,
                'doc_values' => true,
                'ignore_malformed' => false,
                'index' => true,
                'null_value' => null,
                'store' => false,
                'scaling_factor' => 1
            ],
            $property->toArray()
        );
    }

    public function test_scaled_float_numeric_property_can_be_converted_to_array(): void
    {
        $property = (new ScaledFloatNumericProperty('foo'))
            ->setCoerced(false)
            ->setBoost(1.7)
            ->setDocValues(false)
            ->setIgnoreMalformed(true)
            ->setIndexed(false)
            ->setNullValue('NULL')
            ->setStored(true)
            ->setScalingFactor(100);

        $this->assertSame(
            [
                'type' => 'scaled_float',
                'coerce' => false,
                'boost' => 1.7,
                'doc_values' => false,
                'ignore_malformed' => true,
                'index' => false,
                'null_value' => 'NULL',
                'store' => true,
                'scaling_factor' => 100
            ],
            $property->toArray()
        );
    }
}
