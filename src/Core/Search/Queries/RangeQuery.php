<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasFormat;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasTimezone;
use BabenkoIvan\ElasticMate\Core\Content\Types\Range;
use Illuminate\Support\Collection;

final class RangeQuery implements Query
{
    use HasFormat, HasTimezone, HasBoost;

    const RELATION_WITHIN = 'WITHIN';
    const RELATION_CONTAINS = 'CONTAINS';
    const RELATION_INTERSECTS = 'INTERSECTS';

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
    private $relation;

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
     * @param string $relation
     * @return self
     */
    public function setRelation(string $relation): self
    {
        $this->relation = $relation;
        return $this;
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

        if (isset($this->relation)) {
            $query['relation'] = $this->relation;
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
