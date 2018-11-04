<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeCoerced;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

abstract class AbstractNumericProperty extends AbstractProperty
{
    use CanBeCoerced,
        HasBoost,
        HasDocValues,
        CanIgnoreMalformed,
        CanBeIndexed,
        HasNullValue,
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
            'doc_values' => $this->docValues,
            'ignore_malformed' => $this->ignoreMalformed,
            'index' => $this->isIndexed,
            'null_value' => $this->nullValue,
            'store' => $this->isStored
        ];
    }
}
