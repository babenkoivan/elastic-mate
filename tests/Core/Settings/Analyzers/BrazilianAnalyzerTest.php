<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\BrazilianAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class BrazilianAnalyzerTest extends TestCase
{
    public function test_brazilian_analyzer_has_correct_default_values(): void
    {
        $analyzer = new BrazilianAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_BRAZILIAN,
                'stopwords' => Analysis::STOP_WORDS_BRAZILIAN
            ],
            $analyzer->toArray()
        );
    }

    public function test_brazilian_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new BrazilianAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_BRAZILIAN,
                'stopwords_path' => '/stopwords.txt'
            ],
            $analyzer->toArray()
        );
    }
}
