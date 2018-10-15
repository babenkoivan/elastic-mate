<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\SimplePatternTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class SimplePatternTokenizerTest extends TestCase
{
    public function test_simple_pattern_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new SimplePatternTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_SIMPLE_PATTERN,
                'pattern' => ''
            ],
            $tokenizer->toArray()
        );
    }

    public function test_simple_pattern_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new SimplePatternTokenizer('foo'))->setPattern('[0123456789]{3}');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_SIMPLE_PATTERN,
                'pattern' => '[0123456789]{3}'
            ],
            $tokenizer->toArray()
        );
    }
}
