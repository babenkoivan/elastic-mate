<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Search\Queries\Range\GreaterThanOrEqual;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Range\LessThanOrEqual;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\NumericRangeQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\AbstractRange
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\GreaterThanOrEqual
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Queries\Range\LessThanOrEqual
 */
final class NumericRangeQueryTest extends TestCase
{
    public function test_numeric_range_query_can_be_converted_to_array(): void
    {
        $numericRangeQuery = new NumericRangeQuery(
            'foo',
            collect([
                new GreaterThanOrEqual(5),
                new LessThanOrEqual(10)
            ]),
            1.4
        );

        $this->assertSame(
            [
                'range' => [
                    'foo' => [
                        'gte' => 5,
                        'lte' => 10,
                        'boost' => 1.4
                    ]
                ]
            ],
            $numericRangeQuery->toArray()
        );
    }
}
