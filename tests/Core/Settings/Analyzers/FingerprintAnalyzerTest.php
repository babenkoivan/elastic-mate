<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\FingerprintAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
final class FingerprintAnalyzerTest extends TestCase
{
    public function test_fingerprint_analyzer_has_correct_default_values(): void
    {
        $analyzer = new FingerprintAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_FINGERPRINT,
                'separator' => ' ',
                'max_output_size' => 255,
                'stopwords' => Analysis::STOP_WORDS_NONE
            ],
            $analyzer->toArray()
        );
    }

    public function test_fingerprint_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new FingerprintAnalyzer('foo'))
            ->setSeparator('|')
            ->setMaxOutputSize(128)
            ->setStopWords(Analysis::STOP_WORDS_ENGLISH)
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_FINGERPRINT,
                'separator' => '|',
                'max_output_size' => 128,
                'stopwords_path' => '/stopwords.txt'
            ],
            $analyzer->toArray()
        );
    }
}
