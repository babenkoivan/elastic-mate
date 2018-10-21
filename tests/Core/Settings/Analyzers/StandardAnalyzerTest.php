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
final class StandardAnalyzerTest extends TestCase
{
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

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['foo', 64, Analysis::STOP_WORDS_BASQUE],
            ['bar', 128, collect(['stop1', 'stop2'])],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Standard analyzer "$name" can be converted to array
     * @param string $name
     * @param int $maxTokenLength
     * @param Collection|string $stopWords
     */
    public function test_standard_analyzer_can_be_converted_to_array(
        string $name,
        int $maxTokenLength,
        $stopWords
    ): void {
        $analyzer = (new StandardAnalyzer($name))
            ->setMaxTokenLength($maxTokenLength)
            ->setStopWords($stopWords);

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_STANDARD,
                'max_token_length' => $maxTokenLength,
                'stopwords' => is_string($stopWords) ? $stopWords : $stopWords->values()->all()
            ],
            $analyzer->toArray()
        );
    }
}
