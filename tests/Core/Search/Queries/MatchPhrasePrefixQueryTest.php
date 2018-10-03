<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhrasePrefixQuery
 */
final class MatchPhrasePrefixQueryTest extends TestCase
{
    public function test_match_phrase_prefix_query_can_be_converted_to_array(): void
    {
        $matchPhrasePrefixQuery = (new MatchPhrasePrefixQuery('foo', 'bar'))->setMaxExpansions(20);

        $this->assertSame(
            [
                'match_phrase_prefix' => [
                    'foo' => [
                        'query' => 'bar',
                        'max_expansions' => 20
                    ]
                ]
            ],
            $matchPhrasePrefixQuery->toArray()
        );
    }
}
