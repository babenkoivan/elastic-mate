<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\UaxUrlEmailTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class UaxUrlEmailTokenizerTest extends TestCase
{
    public function test_uax_email_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new UaxUrlEmailTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_UAX_URL_EMAIL,
                'max_token_length' => 255
            ],
            $tokenizer->toArray()
        );
    }

    public function test_uax_email_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new UaxUrlEmailTokenizer('foo'))->setMaxTokenLength(128);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_UAX_URL_EMAIL,
                'max_token_length' => 128
            ],
            $tokenizer->toArray()
        );
    }
}
