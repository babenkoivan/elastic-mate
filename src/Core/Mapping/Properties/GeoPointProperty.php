<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreMalformed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanIgnoreZValue;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;

final class GeoPointProperty extends AbstractProperty
{
    use CanIgnoreMalformed, CanIgnoreZValue, HasNullValue;

    /**
     * @inheritdoc
     */
    public function setNullValue($nullValue): self
    {
        if ($nullValue instanceof GeoPoint) {
            $this->nullValue = [
                'lat' => $nullValue->getLatitude(),
                'lon' => $nullValue->getLongitude()
            ];
        } else {
            $this->nullValue = $nullValue;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $property = [
            'type' => 'geo_point',
            'ignore_malformed' => $this->ignoreMalformed,
            'ignore_z_value' => $this->ignoreZValue
        ];

        if (isset($this->nullValue)) {
            $property['null_value'] = $this->nullValue;
        }

        return $property;
    }
}
