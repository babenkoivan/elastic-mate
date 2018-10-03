<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\WildcardQuery
 */
final class WildcardQueryTest extends TestCase
{
    public function test_wildcard_query_can_be_converted_to_array(): void
    {
        $wildcardQuery = (new WildcardQuery('foo', 'b*r'))->setBoost(1.3);

        $this->assertSame(
            [
                'wildcard' => [
                    'foo' => [
                        'wildcard' => 'b*r',
                        'boost' => 1.3
                    ]
                ]
            ],
            $wildcardQuery->toArray()
        );
    }
}
