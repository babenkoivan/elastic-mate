<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\PrefixQuery
 */
final class PrefixQueryTest extends TestCase
{
    public function test_prefix_query_can_be_converted_to_array(): void
    {
        $prefixQuery = (new PrefixQuery('foo', 'ba'))->setBoost(1.7);

        $this->assertSame(
            [
                'prefix' => [
                    'foo' => [
                        'value' => 'ba',
                        'boost' => 1.7
                    ]
                ]
            ],
            $prefixQuery->toArray()
        );
    }
}
