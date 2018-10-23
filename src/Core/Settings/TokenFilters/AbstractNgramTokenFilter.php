<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxGram;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMinGram;

abstract class AbstractNgramTokenFilter extends AbstractTokenFilter
{
    use HasMinGram, HasMaxGram;

    /**
     * @var string
     */
    protected $type;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'min_gram' => $this->minGram,
            'max_gram' => $this->maxGram
        ];
    }
}
