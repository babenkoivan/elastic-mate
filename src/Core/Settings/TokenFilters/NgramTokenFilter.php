<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxGram;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMinGram;

final class NgramTokenFilter extends AbstractTokenFilter
{
    use HasMinGram, HasMaxGram;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_NGRAM,
            'min_gram' => $this->minGram,
            'max_gram' => $this->maxGram
        ];
    }
}
