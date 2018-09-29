<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Support\Range;
use Illuminate\Support\Collection;

final class RangeQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var Collection
     */
    private $range;

    /**
     * @var string|null
     */
    private $format;

    /**
     * @var string|null
     */
    private $timezone;

    /**
     * @var float|null
     */
    private $boost;

    /**
     * @param string $field
     * @param Collection $range
     * @param string|null $format
     * @param string|null $timezone
     * @param float $boost
     */
    public function __construct(
        string $field,
        Collection $range,
        ?string $format = null,
        ?string $timezone = null,
        float $boost = null
    ) {
        $this->field = $field;
        $this->range = $range;
        $this->format = $format;
        $this->timezone = $timezone;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = $this->range->mapWithKeys(function (Range $range) {
            return [$range->getType() => $range->getValue()];
        })->all();

        if (isset($this->format)) {
            $query['format'] = $this->format;
        }

        if (isset($this->timezone)) {
            $query['time_zone'] = $this->timezone;
        }

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'range' => [
                $this->field => $query
            ]
        ];
    }
}
