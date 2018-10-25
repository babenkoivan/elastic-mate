<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\CustomAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 */
final class CustomAnalyzerTest extends TestCase
{
    public function test_custom_analyzer_has_correct_default_values(): void
    {
        $analyzer = new CustomAnalyzer('foo');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_CUSTOM,
                'position_increment_gap' => 100,
                'tokenizer' => Tokenizer::TYPE_STANDARD
            ],
            $analyzer->toArray()
        );
    }

    public function test_custom_analyzer_can_be_converted_to_array(): void
    {
        $analyzer = (new CustomAnalyzer('foo'))
            ->setTokenizer('punctuation')
            ->addCharFilter('emoticons')
            ->addTokenFilter('lowercase')
            ->addTokenFilter('english_stop');

        $this->assertSame(
            [
                'type' => Analyzer::TYPE_CUSTOM,
                'position_increment_gap' => 100,
                'tokenizer' => 'punctuation',
                'char_filter' => [
                    'emoticons'
                ],
                'filter' => [
                    'lowercase',
                    'english_stop'
                ]
            ],
            $analyzer->toArray()
        );
    }
}
