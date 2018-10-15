<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\SimplePatternSplitTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class SimplePatternSplitTokenizerTest extends TestCase
{
    public function test_simple_pattern_split_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new SimplePatternSplitTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_SIMPLE_PATTERN_SPLIT,
                'pattern' => ''
            ],
            $tokenizer->toArray()
        );
    }

    public function test_simple_pattern_split_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new SimplePatternSplitTokenizer('foo'))->setPattern('_');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_SIMPLE_PATTERN_SPLIT,
                'pattern' => '_'
            ],
            $tokenizer->toArray()
        );
    }
}
