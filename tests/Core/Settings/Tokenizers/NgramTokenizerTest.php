<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\NgramTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class NgramTokenizerTest extends TestCase
{
    public function test_ngram_rokenizer_has_correct_default_values(): void
    {
        $tokenizer = new NgramTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_NGRAM,
                'min_gram' => 1,
                'max_gram' => 2
            ],
            $tokenizer->toArray()
        );
    }

    public function test_ngram_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new NgramTokenizer('foo'))
            ->setMinGram(2)
            ->setMaxGram(5)
            ->addTokenChars(NgramTokenizer::CHAR_CLASS_LETTER)
            ->addTokenChars(NgramTokenizer::CHAR_CLASS_DIGIT)
            ->addTokenChars(NgramTokenizer::CHAR_CLASS_PUNCTUATION);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_NGRAM,
                'min_gram' => 2,
                'max_gram' => 5,
                'token_chars' => [
                    NgramTokenizer::CHAR_CLASS_LETTER,
                    NgramTokenizer::CHAR_CLASS_DIGIT,
                    NgramTokenizer::CHAR_CLASS_PUNCTUATION
                ]
            ],
            $tokenizer->toArray()
        );
    }
}
