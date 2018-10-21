<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\EnglishAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class EnglishAnalyzerTest extends TestCase
{
    public function test_english_analyzer_has_correct_default_values(): void
    {
        $analyzer = new EnglishAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ENGLISH,
                'stopwords' => Analysis::STOP_WORDS_ENGLISH
            ],
            $analyzer->toArray()
        );
    }

    public function test_english_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new EnglishAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('bar')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ENGLISH,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['bar']
            ],
            $analyzer->toArray()
        );
    }
}
