<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Queries\MatchPhraseQuery
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\WhitespaceAnalyzer
 */
final class MatchPhraseQueryTest extends TestCase
{
    public function test_match_phrase_query_can_be_converted_to_array(): void
    {
        $matchPhraseQuery = new MatchPhraseQuery('foo', 'bar', 2, new WhitespaceAnalyzer('whitespace'));

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
