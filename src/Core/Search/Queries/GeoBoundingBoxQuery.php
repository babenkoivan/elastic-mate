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
    private $topLeft;

    /**
     * @var GeoPoint
     */
    private $bottomRight;

    /**
     * @var string
     */
    private $type = Query::EXECUTION_TYPE_MEMORY;

    /**
     * @param string $field
     * @param GeoPoint $topLeft
     * @param GeoPoint $bottomRight
     */
    public function __construct(string $field, GeoPoint $topLeft, GeoPoint $bottomRight)
    {
        $this->field = $field;
        $this->topLeft = $topLeft;
        $this->bottomRight = $bottomRight;
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
                        'lat' => $this->topLeft->getLatitude(),
                        'lon' => $this->topLeft->getLongitude()
                    ],
                    'bottom_right' => [
                        'lat' => $this->bottomRight->getLatitude(),
                        'lon' => $this->bottomRight->getLongitude()
                    ]
                ],
                'validation_method' => $this->validationMethod,
                'type' => $this->type
            ]
        ];
    }
}
