<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;

class MatchPhraseQuery implements Query
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
    private $slop;

    /**
     * @var Analyzer|null
     */
    private $analyzer;

    /**
     * @param string $field
     * @param string $query
     * @param int $slop
     * @param Analyzer|null $analyzer
     */
    public function __construct(
        string $field,
        string $query,
        int $slop = 0,
        ?Analyzer $analyzer
    ) {
        $this->field = $field;
        $this->query = $query;
        $this->slop = $slop;
        $this->analyzer = $analyzer;
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
            $query['analyzer'] = $this->analyzer->getName();
        }

        return [
            'match_phrase' => [
                $this->field => $query
            ]
        ];
    }
}
