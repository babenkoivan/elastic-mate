<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\HalfFloatNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractNumericProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class HalfFloatNumericPropertyTest extends TestCase
{
    public function test_half_float_numeric_property_has_correct_default_values(): void
    {
        $property = new HalfFloatNumericProperty('foo');

        $this->assertSame(
            [
                'type' => 'half_float',
                'coerce' => true,
                'boost' => 1,
                'doc_values' => true,
                'ignore_malformed' => false,
                'index' => true,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_half_float_numeric_property_can_be_converted_to_array(): void
    {
        $property = (new HalfFloatNumericProperty('foo'))
            ->setCoerce(false)
            ->setBoost(1.7)
            ->setDocValues(false)
            ->setIgnoreMalformed(true)
            ->setIndex(false)
            ->setNullValue('NULL')
            ->setStore(true);

        $this->assertSame(
            [
                'type' => 'half_float',
                'coerce' => false,
                'boost' => 1.7,
                'doc_values' => false,
                'ignore_malformed' => true,
                'index' => false,
                'store' => true,
                'null_value' => 'NULL'
            ],
            $property->toArray()
        );
    }
}
