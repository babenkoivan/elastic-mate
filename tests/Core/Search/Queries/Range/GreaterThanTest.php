<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\GreaterThan
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\AbstractRange
 */
final class GreaterThanTest extends TestCase
{
    public function test_greater_than_range_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $greaterThan = new GreaterThan(30);

        $this->assertSame('gt', $greaterThan->getAbbreviation());
        $this->assertSame(30, $greaterThan->getValue());
    }
}
