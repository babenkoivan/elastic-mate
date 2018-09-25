<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use Illuminate\Support\Collection;

final class DateRangeQuery extends NumericRangeQuery
{
    /**
     * @var string|null
     */
    private $format;

    /**
     * @var string|null
     */
    private $timezone;

    /**
     * @param string $field
     * @param Collection $range
     * @param string|null $format
     * @param string|null $timezone
     * @param float|null $boost
     */
    public function __construct(
        string $field,
        Collection $range,
        string $format = null,
        string $timezone = null,
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
        $query = parent::toArray();

        if (isset($this->format)) {
            $query['range'][$this->field]['format'] = $this->format;
        }

        if (isset($this->timezone)) {
            $query['range'][$this->field]['time_zone'] = $this->timezone;
        }

        return $query;
    }
}
