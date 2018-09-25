<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\LessThanOrEqual
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\AbstractRange
 */
final class LessThanOrEqualTest
{
    public function test_less_than_range_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $lessThanOrEqual = new LessThanOrEqual(15);

        $this->assertSame('lte', $lessThanOrEqual->getAbbreviation());
        $this->assertSame(15, $lessThanOrEqual->getValue());
    }
}
