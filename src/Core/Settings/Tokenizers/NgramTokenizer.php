<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxGram;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMinGram;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasTokenChars;

final class NgramTokenizer extends AbstractTokenizer
{
    use HasMinGram, HasMaxGram, HasTokenChars;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenizer = [
            'type' => Tokenizer::TYPE_NGRAM,
            'min_gram' => $this->minGram,
            'max_gram' => $this->maxGram
        ];

        if (isset($this->tokenChars)) {
            $tokenizer['token_chars'] = $this->tokenChars->values()->all();
        }

        return $tokenizer;
    }
}
