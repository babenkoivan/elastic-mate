<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\PatternAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
class PatternAnalyzerTest extends TestCase
{
    public function test_pattern_analyzer_has_correct_default_values(): void
    {
        $analyzer = new PatternAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_PATTERN,
                'pattern' => '\W+',
                'lowercase' => true,
                'stopwords' => Analysis::STOP_WORDS_NONE
            ],
            $analyzer->toArray()
        );
    }

    public function test_pattern_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new PatternAnalyzer('foo'))
            ->setPattern('([^\p{L}\d]+)')
            ->addFlag(Analysis::REGEXP_FLAG_CANON_EQ)
            ->addFlag(Analysis::REGEXP_FLAG_CASE_INSENSITIVE)
            ->setLowerCased(false)
            ->setStopWords(collect(['stop1', 'stop2']))
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_PATTERN,
                'pattern' => '([^\p{L}\d]+)',
                'lowercase' => false,
                'stopwords' => ['stop1', 'stop2'],
                'stopwords_path' => '/stopwords.txt',
                'flags' => sprintf('%s|%s', Analysis::REGEXP_FLAG_CANON_EQ, Analysis::REGEXP_FLAG_CASE_INSENSITIVE)
            ],
            $analyzer->toArray()
        );
    }
}
