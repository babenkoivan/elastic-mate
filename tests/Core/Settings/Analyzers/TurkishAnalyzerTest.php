<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\TurkishAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class TurkishAnalyzerTest extends TestCase
{
    public function test_turkish_analyzer_has_correct_default_values(): void
    {
        $analyzer = new TurkishAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_TURKISH,
                'stopwords' => Analysis::STOP_WORDS_TURKISH
            ],
            $analyzer->toArray()
        );
    }

    public function test_turkish_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new TurkishAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('örnek');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_TURKISH,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stem_exclusion' => ['örnek']
            ],
            $analyzer->toArray()
        );
    }
}
