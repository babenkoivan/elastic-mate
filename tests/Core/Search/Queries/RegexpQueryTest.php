<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\RegexpQuery
 */
final class RegexpQueryTest extends TestCase
{
    public function test_regexp_query_can_be_converted_to_array(): void
    {
        $regexpQuery = (new RegexpQuery('foo', 'b.*r'))
            ->setMaxDeterminizedStates(20000)
            ->setBoost(1.6)
            ->addFlag(Query::REGEXP_FLAG_ANYSTRING)
            ->addFlag(Query::REGEXP_FLAG_COMPLEMENT)
            ->addFlag(Query::REGEXP_FLAG_EMPTY)
            ->addFlag(Query::REGEXP_FLAG_INTERSECTION)
            ->addFlag(Query::REGEXP_FLAG_INTERVAL);

        $this->assertSame(
            [
                'regexp' => [
                    'foo' => [
                        'value' => 'b.*r',
                        'flags' => implode('|', [
                            Query::REGEXP_FLAG_ANYSTRING,
                            Query::REGEXP_FLAG_COMPLEMENT,
                            Query::REGEXP_FLAG_EMPTY,
                            Query::REGEXP_FLAG_INTERSECTION,
                            Query::REGEXP_FLAG_INTERVAL
                        ]),
                        'max_determinized_states' => 20000,
                        'boost' => 1.6
                    ]
                ]
            ],
            $regexpQuery->toArray()
        );
    }
}
