<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Content\Types\GeoPoint;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasValidationMethod;

final class GeoBoundingBoxQuery implements Query
{
    use HasValidationMethod;

    /**
     * @var string
     */
    private $field;

    /**
     * @var GeoPoint
     */
    private $topLeftPoint;

    /**
     * @var GeoPoint
     */
    private $bottomRightPoint;

    /**
     * @var string
     */
    private $type = Query::EXECUTION_TYPE_MEMORY;

    /**
     * @param string $field
     * @param GeoPoint $topLeftPoint
     * @param GeoPoint $bottomRightPoint
     */
    public function __construct(string $field, GeoPoint $topLeftPoint, GeoPoint $bottomRightPoint)
    {
        $this->field = $field;
        $this->topLeftPoint = $topLeftPoint;
        $this->bottomRightPoint = $bottomRightPoint;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'geo_bounding_box' => [
                $this->field => [
                    'top_left' => [
                        'lat' => $this->topLeftPoint->getLatitude(),
                        'lon' => $this->topLeftPoint->getLongitude()
                    ],
                    'bottom_right' => [
                        'lat' => $this->bottomRightPoint->getLatitude(),
                        'lon' => $this->bottomRightPoint->getLongitude()
                    ]
                ],
                'validation_method' => $this->validationMethod,
                'type' => $this->type
            ]
        ];
    }
}
