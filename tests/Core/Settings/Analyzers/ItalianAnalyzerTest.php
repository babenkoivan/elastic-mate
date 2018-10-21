<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\ItalianAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class ItalianAnalyzerTest extends TestCase
{
    public function test_italian_analyzer_has_correct_default_values(): void
    {
        $analyzer = new ItalianAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ITALIAN,
                'stopwords' => Analysis::STOP_WORDS_ITALIAN
            ],
            $analyzer->toArray()
        );
    }

    public function test_italian_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new ItalianAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('esempio')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ITALIAN,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['esempio']
            ],
            $analyzer->toArray()
        );
    }
}
