<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\RangeQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Types\Range
 */
final class RangeQueryTest extends TestCase
{
    public function test_date_range_query_can_be_converted_to_array(): void
    {
        $range = collect([
            new Range('01/01/2012', Range::TYPE_GREATER_THAN),
            new Range('01/01/2015', Range::TYPE_LESS_THAN)
        ]);

        $rangeQuery = (new RangeQuery('foo', $range))
            ->setFormat('dd/MM/yyyy')
            ->setTimezone('+01:00')
            ->setBoost(1.9)
            ->setRelation(Query::RELATION_WITHIN);

        $this->assertSame(
            [
                'range' => [
                    'foo' => [
                        'gt' => '01/01/2012',
                        'lt' => '01/01/2015',
                        'format' => 'dd/MM/yyyy',
                        'time_zone' => '+01:00',
                        'relation' => Query::RELATION_WITHIN,
                        'boost' => 1.9,
                    ]
                ]
            ],
            $rangeQuery->toArray()
        );
    }
}
