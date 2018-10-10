<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StopAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
final class StopAnalyzerTest extends TestCase
{
    public function test_stop_analyzer_has_correct_default_values(): void
    {
        $analyzer = new StopAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_STOP,
                'stopwords' => Analysis::STOP_WORDS_ENGLISH
            ],
            $analyzer->toArray()
        );
    }

    public function test_stop_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new StopAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_BRAZILIAN)
            ->setStopWordsPath('/bar.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_STOP,
                'stopwords' => Analysis::STOP_WORDS_BRAZILIAN,
                'stopwords_path' => '/bar.txt'
            ],
            $analyzer->toArray()
        );
    }
}
