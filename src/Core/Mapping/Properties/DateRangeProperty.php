<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasLocale;

final class DateRangeProperty extends AbstractRangeProperty
{
    use HasFormat,
        HasLocale;

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

        $property['format'] = $this->format;
        $property['locale'] = $this->locale;

        return $property;
    }
}
