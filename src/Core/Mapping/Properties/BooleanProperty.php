<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class BooleanProperty extends AbstractProperty
{
    use HasBoost,
        CanUseDocValues,
        CanBeIndexed,
        HasNullValue,
        CanBeStored;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'boolean',
            'boost' => $this->boost,
            'doc_values' => $this->docValues,
            'index' => $this->index,
            'null_value' => $this->nullValue,
            'store' => $this->store
        ];
    }
}
