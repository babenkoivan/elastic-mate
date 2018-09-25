<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Range;
use Illuminate\Support\Collection;

class NumericRangeQuery implements Query
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var Collection
     */
    protected $range;

    /**
     * @var float
     */
    protected $boost;

    /**
     * @param string $field
     * @param Collection $range
     * @param float|null $boost
     */
    public function __construct(
        string $field,
        Collection $range,
        float $boost = null
    ) {
        $this->field = $field;
        $this->range = $range;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = $this->range->mapWithKeys(function (Range $range) {
            return [$range->getAbbreviation() => $range->getValue()];
        })->all();

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
