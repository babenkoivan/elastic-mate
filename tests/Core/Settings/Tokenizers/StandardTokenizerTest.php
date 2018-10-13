<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\StandardTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class StandardTokenizerTest extends TestCase
{
    public function test_standard_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new StandardTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_STANDARD,
                'max_token_length' => 255
            ],
            $tokenizer->toArray()
        );
    }

    public function test_standard_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new StandardTokenizer('foo'))->setMaxTokenLength(128);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_STANDARD,
                'max_token_length' => 128
            ],
            $tokenizer->toArray()
        );
    }
}
