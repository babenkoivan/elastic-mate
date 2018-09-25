<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\LessThan
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\AbstractRange
 */
final class LessThanTest
{
    public function test_less_than_range_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $lessThan = new LessThan(5);

        $this->assertSame('lt', $lessThan->getAbbreviation());
        $this->assertSame(5, $lessThan->getValue());
    }
}
