<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;
use Illuminate\Support\Collection;

final class BoolQuery implements Query
{
    use HasBoost;

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
     * @var Collection
     */
    private $should;

    /**
     * @var int|null
     */
    private $minimumShouldMatch;

    public function __construct()
    {
        $this->should = collect();
    }

    /**
     * @param Query $must
     * @return self
     */
    public function setMust(Query $must): self
    {
        $this->must = $must;
        return $this;
    }

    /**
     * @param Query $filter
     * @return BoolQuery
     */
    public function setFilter(Query $filter): self
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param Query $mustNot
     * @return BoolQuery
     */
    public function setMustNot(Query $mustNot): self
    {
        $this->mustNot = $mustNot;
        return $this;
    }

    /**
     * @param Query $should
     * @return BoolQuery
     */
    public function addShould(Query $should): self
    {
        $this->should->push($should);
        return $this;
    }

    /**
     * @param int $minimumShouldMatch
     * @return BoolQuery
     */
    public function setMinimumShouldMatch(int $minimumShouldMatch): self
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
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

        if ($this->should->count() > 0) {
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
