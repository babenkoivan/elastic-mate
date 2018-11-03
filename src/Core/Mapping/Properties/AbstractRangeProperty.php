<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeCoerced;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;

abstract class AbstractRangeProperty extends AbstractProperty
{
    use CanBeCoerced,
        HasBoost,
        CanBeIndexed,
        CanBeStored;

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
            'coerce' => $this->isCoerced,
            'boost' => $this->boost,
            'index' => $this->isIndexed,
            'store' => $this->isStored
        ];
    }
}
