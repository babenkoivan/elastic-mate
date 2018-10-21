<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\ArabicAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class ArabicAnalyzerTest extends TestCase
{
    public function test_arabic_analyzer_has_correct_default_values(): void
    {
        $analyzer = new ArabicAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ARABIC,
                'stopwords' => Analysis::STOP_WORDS_ARABIC
            ],
            $analyzer->toArray()
        );
    }

    public function test_arabic_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new ArabicAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('مثال')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_ARABIC,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['مثال']
            ],
            $analyzer->toArray()
        );
    }
}
