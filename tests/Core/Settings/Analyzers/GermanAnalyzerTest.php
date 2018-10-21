<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\GermanAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class GermanAnalyzerTest extends TestCase
{
    public function test_german_analyzer_has_correct_default_values(): void
    {
        $analyzer = new GermanAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_GERMAN,
                'stopwords' => Analysis::STOP_WORDS_GERMAN
            ],
            $analyzer->toArray()
        );
    }

    public function test_german_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new GermanAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('Beispiel')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_GERMAN,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['beispiel']
            ],
            $analyzer->toArray()
        );
    }
}
