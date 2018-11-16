<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoDistance;
use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasValidationMethod;

final class GeoDistanceQuery implements Query
{
    use HasValidationMethod;

    /**
     * @var string
     */
    private $field;

    /**
     * @var GeoPoint
     */
    private $point;

    /**
     * @var GeoDistance
     */
    private $distance;

    /**
     * @var string
     */
    private $distanceType = Query::DISTANCE_TYPE_ARC;

    /**
     * @param string $field
     * @param GeoPoint $point
     * @param GeoDistance $distance
     */
    public function __construct(string $field, GeoPoint $point, GeoDistance $distance)
    {
        $this->field = $field;
        $this->point = $point;
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getDistanceType(): string
    {
        return $this->distanceType;
    }

    /**
     * @param string $distanceType
     * @return self
     */
    public function setDistanceType(string $distanceType): self
    {
        $this->distanceType = $distanceType;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'geo_distance' => [
                $this->field => [
                    'lat' => $this->point->getLatitude(),
                    'lon' => $this->point->getLongitude()
                ],
                'distance' => $this->distance->getDistance() . $this->distance->getUnit(),
                'distance_type' => $this->distanceType,
                'validation_method' => $this->validationMethod
            ]
        ];
    }
}
