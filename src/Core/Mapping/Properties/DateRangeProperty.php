<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasLocale;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class DateRangeProperty extends AbstractRangeProperty
{
    use HasDocValues,
        HasFormat,
        HasLocale,
        CanIgnoreMalformed,
        HasNullValue;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->type = 'date_range';
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $property = parent::toArray();

        $property['doc_values'] = $this->docValues;
        $property['format'] = $this->format;
        $property['locale'] = $this->locale;
        $property['ignore_malformed'] = $this->ignoreMalformed;
        $property['null_value'] = $this->nullValue;

        return $property;
    }
}
