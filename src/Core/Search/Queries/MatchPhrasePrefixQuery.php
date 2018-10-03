<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasMaxExpansions;

final class MatchPhrasePrefixQuery implements Query
{
    use HasMaxExpansions;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $query;

    /**
     * @param string $field
     * @param string $query
     */
    public function __construct(string $field, string $query)
    {
        $this->field = $field;
        $this->query = $query;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'match_phrase_prefix' => [
                $this->field => [
                    'query' => $this->query,
                    'max_expansions' => $this->maxExpansions
                ]
            ]
        ];
    }
}
