<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreZValue;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class GeoPointProperty extends AbstractProperty
{
    use CanIgnoreMalformed, CanIgnoreZValue, HasNullValue;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'geo_point',
            'ignore_malformed' => $this->ignoreMalformed,
            'ignore_z_value' => $this->ignoreZValue,
            'null_value' => $this->nullValue
        ];
    }
}