<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\GreaterThanOrEqual
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\AbstractRange
 */
final class GreaterThanOrEqualTest extends TestCase
{
    public function test_greater_than_or_equal_range_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $greaterThanOrEqual = new GreaterThanOrEqual(10);

        $this->assertSame('gte', $greaterThanOrEqual->getAbbreviation());
        $this->assertSame(10, $greaterThanOrEqual->getValue());
    }
}
