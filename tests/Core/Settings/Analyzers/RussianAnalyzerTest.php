<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\RussianAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class RussianAnalyzerTest extends TestCase
{
    public function test_russian_analyzer_has_correct_default_values(): void
    {
        $analyzer = new RussianAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_RUSSIAN,
                'stopwords' => Analysis::STOP_WORDS_RUSSIAN
            ],
            $analyzer->toArray()
        );
    }

    public function test_russian_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new RussianAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('пример')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_RUSSIAN,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['пример']
            ],
            $analyzer->toArray()
        );
    }
}
