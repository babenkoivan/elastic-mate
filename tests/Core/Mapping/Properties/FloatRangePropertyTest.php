<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\FloatRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class FloatRangePropertyTest extends TestCase
{
    public function test_float_range_property_has_correct_default_values(): void
    {
        $property = new FloatRangeProperty('foo');

        $this->assertSame(
            [
                'type' => 'float_range',
                'coerce' => true,
                'boost' => 1,
                'index' => true,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_float_range_property_can_be_converted_to_array(): void
    {
        $property = (new FloatRangeProperty('foo'))
            ->setCoerce(false)
            ->setBoost(1.2)
            ->setIndex(false)
            ->setStore(true);

        $this->assertSame(
            [
                'type' => 'float_range',
                'coerce' => false,
                'boost' => 1.2,
                'index' => false,
                'store' => true
            ],
            $property->toArray()
        );
    }
}
