<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class IpProperty extends AbstractProperty
{
    use HasDocValues,
        CanBeStored,
        CanBeIndexed,
        HasNullValue,
        HasBoost;

    /**
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'ip',
            'doc_values' => $this->docValues,
            'store' => $this->isStored,
            'index' => $this->isIndexed,
            'null_value' => $this->nullValue,
            'boost' => $this->boost
        ];
    }
}
