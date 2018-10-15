<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasBufferSize;

final class KeywordTokenizer extends AbstractTokenizer
{
    use HasBufferSize;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => Tokenizer::TYPE_KEYWORD,
            'buffer_size' => $this->bufferSize
        ];
    }
}
