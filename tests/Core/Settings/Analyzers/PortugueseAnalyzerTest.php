<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\PortugueseAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class PortugueseAnalyzerTest extends TestCase
{
    public function test_portuguese_analyzer_has_correct_default_values(): void
    {
        $analyzer = new PortugueseAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_PORTUGUESE,
                'stopwords' => Analysis::STOP_WORDS_PORTUGUESE
            ],
            $analyzer->toArray()
        );
    }

    public function test_portuguese_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new PortugueseAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('exemplo')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_PORTUGUESE,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['exemplo']
            ],
            $analyzer->toArray()
        );
    }
}
