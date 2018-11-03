<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\LongRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class LongRangePropertyTest extends TestCase
{
    public function test_long_range_property_has_correct_default_values(): void
    {
        $property = new LongRangeProperty('foo');

        $this->assertSame(
            [
                'type' => 'long_range',
                'coerce' => true,
                'boost' => 1,
                'index' => true,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_long_range_property_can_be_converted_to_array(): void
    {
        $property = (new LongRangeProperty('foo'))
            ->setCoerced(false)
            ->setBoost(1.2)
            ->setIndexed(false)
            ->setStored(true);

        $this->assertSame(
            [
                'type' => 'long_range',
                'coerce' => false,
                'boost' => 1.2,
                'index' => false,
                'store' => true
            ],
            $property->toArray()
        );
    }
}
