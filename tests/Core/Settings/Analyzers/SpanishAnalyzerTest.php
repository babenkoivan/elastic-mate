<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\SpanishAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class SpanishAnalyzerTest extends TestCase
{
    public function test_spanish_analyzer_has_correct_default_values(): void
    {
        $analyzer = new SpanishAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_SPANISH,
                'stopwords' => Analysis::STOP_WORDS_SPANISH
            ],
            $analyzer->toArray()
        );
    }

    public function test_spanish_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new SpanishAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('ejemplo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_SPANISH,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stem_exclusion' => ['ejemplo']
            ],
            $analyzer->toArray()
        );
    }
}
