<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
class StandardAnalyzerTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['foo', 64, Analysis::STOP_WORDS_BASQUE, '/stopwords.txt'],
            ['bar', 128, collect(['stop1', 'stop2']), '/app/stopwords.txt'],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Standard analyzer "$name" can be converted to array
     * @param string $name
     * @param int $maxTokenLength
     * @param Collection|string $stopWords
     * @param string $stopWordsPath
     */
    public function test_standard_analyzer_can_be_converted_to_array(
        string $name,
        int $maxTokenLength,
        $stopWords,
        string $stopWordsPath
    ): void {
        $analyzer = (new StandardAnalyzer($name))
            ->setMaxTokenLength($maxTokenLength)
            ->setStopWords($stopWords)
            ->setStopWordsPath($stopWordsPath);

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_STANDARD,
                'max_token_length' => $maxTokenLength,
                'stopwords' => is_string($stopWords) ? $stopWords : $stopWords->values()->all(),
                'stopwords_path' => $stopWordsPath
            ],
            $analyzer->toArray()
        );
    }

    public function test_standard_analyzer_has_correct_default_values(): void
    {
        $analyzer = new StandardAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_STANDARD,
                'max_token_length' => 255,
                'stopwords' => Analysis::STOP_WORDS_NONE
            ],
            $analyzer->toArray()
        );
    }
}
