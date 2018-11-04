<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasAnalyzer;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasCutoffFrequency;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasFuzziness;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\CanBeLenient;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasMaxExpansions;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasOperator;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasPrefixLength;

class MatchQuery implements Query
{
    use HasOperator,
        HasAnalyzer,
        CanBeLenient,
        HasFuzziness,
        HasPrefixLength,
        HasMaxExpansions,
        HasCutoffFrequency;

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
        $query = [
            'query' => $this->query,
            'operator' => $this->operator,
            'lenient' => $this->lenient,
            'prefix_length' => $this->prefixLength,
            'max_expansions' => $this->maxExpansions
        ];

        if (isset($this->analyzer)) {
            $query['analyzer'] = $this->analyzer;
        }

        if (isset($this->fuzziness)) {
            $query['fuzziness'] = $this->fuzziness->toString();
            $query['fuzzy_transpositions'] = $this->fuzziness->isTransposable();
        }

        if (isset($this->cutoffFrequency)) {
            $query['cutoff_frequency'] = $this->cutoffFrequency;
        }

        return [
            'match' => [
                $this->field => $query
            ]
        ];
    }
}
