<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasLocale;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class DateProperty extends AbstractProperty
{
    use HasBoost,
        HasDocValues,
        HasFormat,
        HasLocale,
        CanIgnoreMalformed,
        CanBeIndexed,
        HasNullValue,
        CanBeStored;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'date',
            'boost' => $this->boost,
            'doc_values' => $this->docValues,
            'format' => $this->format,
            'locale' => $this->locale,
            'ignore_malformed' => $this->ignoreMalformed,
            'index' => $this->isIndexed,
            'null_value' => $this->nullValue,
            'store' => $this->isStored
        ];
    }
}
