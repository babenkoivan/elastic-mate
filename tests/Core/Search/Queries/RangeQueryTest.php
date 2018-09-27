<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Search\Support\Range;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\RangeQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Search\Support\Range
 */
final class RangeQueryTest extends TestCase
{
    public function test_date_range_query_can_be_converted_to_array(): void
    {
        $rangeQuery = new RangeQuery(
            'foo',
            collect([
                new Range('01/01/2012', Range::TYPE_GREATER_THAN),
                new Range('01/01/2015', Range::TYPE_LESS_THAN)
            ]),
            'dd/MM/yyyy',
            '+01:00',
            1.9
        );

        $this->assertSame(
            [
                'range' => [
                    'foo' => [
                        'gt' => '01/01/2012',
                        'lt' => '01/01/2015',
                        'format' => 'dd/MM/yyyy',
                        'time_zone' => '+01:00',
                        'boost' => 1.9,
                    ]
                ]
            ],
            $rangeQuery->toArray()
        );
    }
}
