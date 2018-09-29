<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Support\Fuzziness;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;

class MatchQuery implements Query
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
     * @var string
     */
    private $operator;

    /**
     * @var Fuzziness|null
     */
    private $fuzziness;

    /**
     * @var int
     */
    private $prefixLength;

    /**
     * @var int
     */
    private $maxExpansions;

    /**
     * @var Analyzer|null
     */
    private $analyzer;

    /**
     * @var int|null
     */
    private $cutoffFrequency;

    /**
     * @var bool
     */
    private $isLenient;

    /**
     * @param string $field
     * @param string $query
     * @param string $operator
     * @param Fuzziness|null $fuzziness
     * @param int $prefixLength
     * @param int $maxExpansions
     * @param Analyzer|null $analyzer
     * @param float|null $cutoffFrequency
     * @param bool $isLenient
     */
    public function __construct(
        string $field,
        string $query,
        string $operator = Query::OPERATOR_OR,
        ?Fuzziness $fuzziness = null,
        int $prefixLength = 0,
        int $maxExpansions = 50,
        ?Analyzer $analyzer = null,
        ?float $cutoffFrequency = null,
        bool $isLenient = false
    ) {
        $this->field = $field;
        $this->query = $query;
        $this->operator = $operator;
        $this->fuzziness = $fuzziness;
        $this->prefixLength = $prefixLength;
        $this->maxExpansions = $maxExpansions;
        $this->analyzer = $analyzer;
        $this->cutoffFrequency = $cutoffFrequency;
        $this->isLenient = $isLenient;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'query' => $this->query,
            'operator' => $this->operator,
            'lenient' => $this->isLenient ? 'true' : 'false',
            'prefix_length' => $this->prefixLength,
            'max_expansions' => $this->maxExpansions
        ];

        if (isset($this->fuzziness)) {
            $query['fuzziness'] = $this->fuzziness->toString();
            $query['fuzzy_transpositions'] = $this->fuzziness->isTransposable() ? 'true' : 'false';
        }

        if (isset($this->analyzer)) {
            $query['analyzer'] = $this->analyzer->getName();
        }

        return [
            'match' => [
                $this->field => $query
            ]
        ];
    }
}
