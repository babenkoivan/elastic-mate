<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use Illuminate\Support\Collection;
use InvalidArgumentException;

final class BoolQuery implements Query
{
    /**
     * @var Query|null
     */
    private $must;

    /**
     * @var Query|null
     */
    private $filter;

    /**
     * @var Query|null
     */
    private $mustNot;

    /**
     * @var Collection|null
     */
    private $should;

    /**
     * @var int|null
     */
    private $minimumShouldMatch;

    /**
     * @var float|null
     */
    private $boost;

    /**
     * @param Query|null $must
     * @param Query|null $filter
     * @param Query|null $mustNot
     * @param Collection|null $should
     * @param int|null $minimumShouldMatch
     * @param float $boost
     */
    public function __construct(
        ?Query $must = null,
        ?Query $filter = null,
        ?Query $mustNot = null,
        ?Collection $should = null,
        ?int $minimumShouldMatch = null,
        float $boost = null
    ) {
        if (!isset($must) && !isset($filter) && !isset($mustNot) && !isset($should)) {
            throw new InvalidArgumentException(
                'At least one of the boolean clauses must be used: must, filter, must not, should'
            );
        }

        $this->must = $must;
        $this->filter = $filter;
        $this->mustNot = $mustNot;
        $this->should = $should;
        $this->minimumShouldMatch = $minimumShouldMatch;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [];

        if (isset($this->must)) {
            $query['must'] = $this->must->toArray();
        }

        if (isset($this->filter)) {
            $query['filter'] = $this->filter->toArray();
        }

        if (isset($this->mustNot)) {
            $query['must_not'] = $this->mustNot->toArray();
        }

        if (isset($this->should)) {
            $query['should'] = $this->should->map(function (Query $query) {
                return $query->toArray();
            })->values()->all();
        }

        if (isset($this->minimumShouldMatch)) {
            $query['minimum_should_match'] = $this->minimumShouldMatch;
        }

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'bool' => $query
        ];
    }
}
