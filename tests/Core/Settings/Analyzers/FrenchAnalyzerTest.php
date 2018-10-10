<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\FrenchAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractLanguageAnalyzer
 */
final class FrenchAnalyzerTest extends TestCase
{
    public function test_french_analyzer_has_correct_default_values(): void
    {
        $analyzer = new FrenchAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_FRENCH,
                'stopwords' => Analysis::STOP_WORDS_FRENCH
            ],
            $analyzer->toArray()
        );
    }

    public function test_french_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new FrenchAnalyzer('foo'))
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->addStemExclusion('Exemple')
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_FRENCH,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stopwords_path' => '/stopwords.txt',
                'stem_exclusion' => ['exemple']
            ],
            $analyzer->toArray()
        );
    }
}
