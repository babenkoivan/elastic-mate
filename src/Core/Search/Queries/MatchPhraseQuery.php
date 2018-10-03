<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasAnalyzer;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasSlop;

final class MatchPhraseQuery implements Query
{
    use HasSlop, HasAnalyzer;

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
    public function __construct(string $field, string $query) {
        $this->field = $field;
        $this->query = $query;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'query' => $this->query,
            'slop' => $this->slop
        ];

        if (isset($this->analyzer)) {
            $query['analyzer'] = $this->analyzer;
        }

        return [
            'match_phrase' => [
                $this->field => $query
            ]
        ];
    }
}
