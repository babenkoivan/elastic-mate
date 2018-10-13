<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxTokenLength;

final class UaxUrlEmailTokenizer extends AbstractTokenizer
{
    use HasMaxTokenLength;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => Tokenizer::TYPE_UAX_URL_EMAIL,
            'max_token_length' => $this->maxTokenLength
        ];
    }
}
