<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\EdgeNgramTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\NgramTokenizer
 */
final class EdgeNgramTokenizerTest extends TestCase
{
    public function test_edge_ngram_rokenizer_has_correct_default_values(): void
    {
        $tokenizer = new EdgeNgramTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_EDGE_NGRAM,
                'min_gram' => 1,
                'max_gram' => 2
            ],
            $tokenizer->toArray()
        );
    }

    public function test_edge_ngram_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new EdgeNgramTokenizer('foo'))
            ->setMinGram(2)
            ->setMaxGram(5)
            ->addTokenChars(EdgeNgramTokenizer::CHAR_CLASS_LETTER)
            ->addTokenChars(EdgeNgramTokenizer::CHAR_CLASS_SYMBOL);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_EDGE_NGRAM,
                'min_gram' => 2,
                'max_gram' => 5,
                'token_chars' => [
                    NgramTokenizer::CHAR_CLASS_LETTER,
                    NgramTokenizer::CHAR_CLASS_SYMBOL
                ]
            ],
            $tokenizer->toArray()
        );
    }
}
