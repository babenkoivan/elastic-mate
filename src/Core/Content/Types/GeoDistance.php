<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Types;

final class GeoDistance
{
    const UNIT_MILE = 'mi';
    const UNIT_YARD = 'yd';
    const UNIT_FEET = 'ft';
    const UNIT_INCH = 'in';
    const UNIT_KILOMETER = 'km';
    const UNIT_METER = 'm';
    const UNIT_CENTIMETER = 'cm';
    const UNIT_MILLIMETER = 'mm';
    const UNIT_NAUTICAL_MILE = 'nmi';

    /**
     * @var float
     */
    private $distance;

    /**
     * @var string
     */
    private $unit;

    /**
     * @param float $distance
     * @param string $unit
     */
    public function __construct(float $distance, string $unit)
    {
        $this->distance = $distance;
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
