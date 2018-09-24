<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\ExistsQuery
 */
final class ExistsQueryTest extends TestCase
{
    public function test_exists_query_can_be_converted_to_array(): void
    {
        $existsQuery = new ExistsQuery('foo');

        $this->assertSame(
            [
                'exists' => [
                    'field' => 'foo'
                ]
            ],
            $existsQuery->toArray()
        );
    }
}
