<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasLocale;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class DateProperty extends AbstractProperty
{
    use HasBoost,
        CanUseDocValues,
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
        $property = [
            'type' => 'date',
            'boost' => $this->boost,
            'doc_values' => $this->docValues,
            'format' => $this->format,
            'locale' => $this->locale,
            'ignore_malformed' => $this->ignoreMalformed,
            'index' => $this->index,
            'store' => $this->store
        ];

        if (isset($this->nullValue)) {
            $property['null_value'] = $this->nullValue;
        }

        return $property;
    }
}
