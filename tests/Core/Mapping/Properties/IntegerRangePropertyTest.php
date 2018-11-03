<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Mapping\Properties\IntegerRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractRangeProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 */
final class IntegerRangePropertyTest extends TestCase
{
    public function test_integer_range_property_has_correct_default_values(): void
    {
        $property = new IntegerRangeProperty('foo');

        $this->assertSame(
            [
                'type' => 'integer_range',
                'coerce' => true,
                'boost' => 1,
                'index' => true,
                'store' => false
            ],
            $property->toArray()
        );
    }

    public function test_integer_range_property_can_be_converted_to_array(): void
    {
        $property = (new IntegerRangeProperty('foo'))
            ->setCoerced(false)
            ->setBoost(1.2)
            ->setIndexed(false)
            ->setStored(true);

        $this->assertSame(
            [
                'type' => 'integer_range',
                'coerce' => false,
                'boost' => 1.2,
                'index' => false,
                'store' => true
            ],
            $property->toArray()
        );
    }
}
