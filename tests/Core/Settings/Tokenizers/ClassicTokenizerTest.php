<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\ClassicTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class ClassicTokenizerTest extends TestCase
{
    public function test_classic_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new ClassicTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_CLASSIC,
                'max_token_length' => 255
            ],
            $tokenizer->toArray()
        );
    }

    public function test_classic_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new ClassicTokenizer('foo'))->setMaxTokenLength(128);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_CLASSIC,
                'max_token_length' => 128
            ],
            $tokenizer->toArray()
        );
    }
}
