<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\CharGroupTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class CharGroupTokenizerTest extends TestCase
{
    public function test_char_group_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new CharGroupTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_CHAR_GROUP
            ],
            $tokenizer->toArray()
        );
    }

    public function test_char_group_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new CharGroupTokenizer('foo'))
            ->tokenizeOnChar('-')
            ->tokenizeOnChar(Analysis::CHAR_GROUP_LETTER);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_CHAR_GROUP,
                'tokenize_on_chars' => [
                    '-',
                    Analysis::CHAR_GROUP_LETTER
                ]
            ],
            $tokenizer->toArray()
        );
    }
}
