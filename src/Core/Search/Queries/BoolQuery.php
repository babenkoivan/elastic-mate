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
     * @var Collection
     */
    private $must;

    /**
     * @var Collection
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

    /**
     * @var Collection
     */
    private $filter;

    public function __construct()
    {
        $this->must = collect();
        $this->mustNot = collect();
        $this->should = collect();
        $this->filter = collect();
    }

    /**
     * @param Query $must
     * @return self
     */
    public function addMust(Query $must): self
    {
        $this->must->push($must);
        return $this;
    }

    /**
     * @param Query $mustNot
     * @return self
     */
    public function addMustNot(Query $mustNot): self
    {
        $this->mustNot->push($mustNot);
        return $this;
    }

    /**
     * @param Query $should
     * @return self
     */
    public function addShould(Query $should): self
    {
        $this->should->push($should);
        return $this;
    }

    /**
     * @param int $minimumShouldMatch
     * @return self
     */
    public function setMinimumShouldMatch(int $minimumShouldMatch): self
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
    }

    /**
     * @param Query $filter
     * @return self
     */
    public function addFilter(Query $filter): self
    {
        $this->filter->push($filter);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [];

        $clauseFieldMapping = collect([
            'must' => 'must',
            'mustNot' => 'must_not',
            'should' => 'should',
            'filter' => 'filter'
        ]);

        $clauseFieldMapping->each(function (string $field, string $property) use (&$query) {
            if (isset($this->{$property})) {
                $query[$field] = $this->{$property}->map(function (Query $query) {
                    return $query->toArray();
                })->values()->all();
            }
        });

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
