<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhraseQuery
 */
final class MatchPhraseQueryTest extends TestCase
{
    public function test_match_phrase_query_can_be_converted_to_array(): void
    {
        $matchPhraseQuery = (new MatchPhraseQuery('foo', 'bar'))
            ->setAnalyzer('whitespace')
            ->setSlop(2);

        $this->assertSame(
            [
                'match_phrase' => [
                    'foo' => [
                        'query' => 'bar',
                        'slop' => 2,
                        'analyzer' => 'whitespace'
                    ]
                ]
            ],
            $matchPhraseQuery->toArray()
        );
    }
}
