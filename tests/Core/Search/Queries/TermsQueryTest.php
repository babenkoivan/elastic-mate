<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\TermsQuery
 */
final class TermsQueryTest extends TestCase
{
    public function test_terms_query_can_be_converted_to_array(): void
    {
        $termsQuery = new TermsQuery('test', collect(['foo', 'bar']));

        $this->assertSame(
            [
                'terms' => [
                    'test' => ['foo', 'bar']
                ]
            ],
            $termsQuery->toArray()
        );
    }
}
