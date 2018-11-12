<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Types;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Content\Types\Range
 */
final class RangeTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [1, Range::TYPE_GREATER_THAN],
            [2, Range::TYPE_GREATER_THAN_OR_EQUAL],
            [3, Range::TYPE_LESS_THAN],
            [4, Range::TYPE_LESS_THAN_OR_EQUAL],
            ['now', Range::TYPE_GREATER_THAN],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Range "$value" of "$type" type can be created and properties can be received via getters
     * @param $value
     * @param string $type
     */
    public function test_range_can_be_created_and_properties_can_be_received_via_getters($value, string $type): void
    {
        $range = new Range($value, $type);

        $this->assertSame($value, $range->getValue());
        $this->assertSame($type, $range->getType());
    }
}
