<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\SwedishAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class SwedishAnalyzerTest extends TestCase
{
    public function test_swedish_analyzer_has_correct_default_values(): void
    {
        $analyzer = new SwedishAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_SWEDISH,
                'stopwords' => Analysis::STOP_WORDS_SWEDISH
            ],
            $analyzer->toArray()
        );
    }

    public function test_swedish_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new SwedishAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('exempel')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_SWEDISH,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['exempel']
            ],
            $analyzer->toArray()
        );
    }
}
