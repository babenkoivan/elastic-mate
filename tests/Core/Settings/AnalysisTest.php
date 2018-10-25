<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\HtmlStripCharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\EdgeNgramTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\ClassicTokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\PatternTokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\PatternTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\ClassicTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\AbstractCharacterFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters\HtmlStripCharacterFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractNgramTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\EdgeNgramTokenFilter
 */
final class AnalysisTest extends TestCase
{
    public function test_analysis_can_be_converted_to_array(): void
    {
        $standardAnalyzer = new StandardAnalyzer('standard_analyzer');
        $stopAnalyzer = new StopAnalyzer('stop_analyzer');
        $patternTokenizer = new PatternTokenizer('pattern_tokenizer');
        $classicTokenizer = new ClassicTokenizer('classic_tokenizer');
        $htmlStripCharFilter = new HtmlStripCharacterFilter('html_strip_char_filter');
        $lengthTokenFilter = new LengthTokenFilter('length_token_filter');
        $edgeNgramTokenFilter = new EdgeNgramTokenFilter('edge_ngram_token_filter');

        $analysis = (new Analysis())
            ->addAnalyzer($standardAnalyzer)
            ->addAnalyzer($stopAnalyzer)
            ->addTokenizer($patternTokenizer)
            ->addTokenizer($classicTokenizer)
            ->addCharFilter($htmlStripCharFilter)
            ->addTokenFilter($lengthTokenFilter)
            ->addTokenFilter($edgeNgramTokenFilter);

        $this->assertSame(
            [
                'analyzer' => [
                    'standard_analyzer' => $standardAnalyzer->toArray(),
                    'stop_analyzer' => $stopAnalyzer->toArray(),
                ],
                'tokenizer' => [
                    'pattern_tokenizer' => $patternTokenizer->toArray(),
                    'classic_tokenizer' => $classicTokenizer->toArray()
                ],
                'char_filter' => [
                    'html_strip_char_filter' => $htmlStripCharFilter->toArray()
                ],
                'filter' => [
                    'length_token_filter' => $lengthTokenFilter->toArray(),
                    'edge_ngram_token_filter' => $edgeNgramTokenFilter->toArray()
                ]
            ],
            $analysis->toArray()
        );
    }
}
