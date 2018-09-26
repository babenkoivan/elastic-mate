<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\RegexpQuery
 */
final class RegexpQueryTest extends TestCase
{
    public function test_regexp_query_can_be_converted_to_array(): void
    {
        $regexpQuery = new RegexpQuery(
            'foo',
            'b.*r',
            collect([
                RegexpQuery::FLAG_ANYSTRING,
                RegexpQuery::FLAG_COMPLEMENT,
                RegexpQuery::FLAG_EMPTY,
                RegexpQuery::FLAG_INTERSECTION,
                RegexpQuery::FLAG_INTERVAL
            ]),
            20000,
            1.6
        );

        $this->assertSame(
            [
                'regexp' => [
                    'foo' => [
                        'value' => 'b.*r',
                        'flags' => 'ANYSTRING|COMPLEMENT|EMPTY|INTERSECTION|INTERVAL',
                        'max_determinized_states' => 20000,
                        'boost' => 1.6
                    ]
                ]
            ],
            $regexpQuery->toArray()
        );
    }
}
