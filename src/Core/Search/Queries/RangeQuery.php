<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasTimezone;
use BabenkoIvan\ElasticMate\Core\Support\Range;
use Illuminate\Support\Collection;

final class RangeQuery implements Query
{
    use HasFormat, HasTimezone, HasBoost;

    /**
     * @var string
     */
    private $field;

    /**
     * @var Collection
     */
    private $range;

    /**
     * @param string $field
     * @param Collection $range
     */
    public function __construct(string $field, Collection $range)
    {
        $this->field = $field;
        $this->range = $range;
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
