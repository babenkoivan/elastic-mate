<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxTokenLength;

final class ClassicTokenizer extends AbstractTokenizer
{
    use HasMaxTokenLength;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => Tokenizer::TYPE_CLASSIC,
            'max_token_length' => $this->maxTokenLength
        ];
    }
}
