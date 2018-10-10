<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\HindiAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class HindiAnalyzerTest extends TestCase
{
    public function test_hindi_analyzer_has_correct_default_values(): void
    {
        $analyzer = new HindiAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_HINDI,
                'stopwords' => Analysis::STOP_WORDS_HINDI
            ],
            $analyzer->toArray()
        );
    }

    public function test_hindi_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new HindiAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('उदाहरण')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_HINDI,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['उदाहरण']
            ],
            $analyzer->toArray()
        );
    }
}
