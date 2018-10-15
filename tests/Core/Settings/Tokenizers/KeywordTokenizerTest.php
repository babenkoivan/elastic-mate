<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\KeywordTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class KeywordTokenizerTest extends TestCase
{
    public function test_keyword_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new KeywordTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_KEYWORD,
                'buffer_size' => 256
            ],
            $tokenizer->toArray()
        );
    }

    public function test_keyword_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new KeywordTokenizer('foo'))->setBufferSize(64);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_KEYWORD,
                'buffer_size' => 64
            ],
            $tokenizer->toArray()
        );
    }
}
