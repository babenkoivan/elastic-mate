<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;

final class EdgeNgramTokenizer extends NgramTokenizer
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'type' => Tokenizer::TYPE_EDGE_NGRAM
        ]);
    }
}
