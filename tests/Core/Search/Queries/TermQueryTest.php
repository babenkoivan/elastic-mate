<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\TermQuery
 */
final class TermQueryTest extends TestCase
{
    public function test_term_query_can_be_converted_to_array(): void
    {
        $termQuery = new TermQuery('foo', 'bar', 1.5);

        $this->assertSame(
            [
                'term' => [
                    'foo' => [
                        'value' => 'bar',
                        'boost' => 1.5
                    ]
                ]
            ],
            $termQuery->toArray()
        );
    }
}
