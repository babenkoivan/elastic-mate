<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;

class MatchPhrasePrefixQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $query;

    /**
     * @var int
     */
    private $maxExpansions;

    /**
     * @param string $field
     * @param string $query
     * @param int $maxExpansions
     */
    public function __construct(string $field, string $query, int $maxExpansions = 50)
    {
        $this->field = $field;
        $this->query = $query;
        $this->maxExpansions = $maxExpansions;
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
