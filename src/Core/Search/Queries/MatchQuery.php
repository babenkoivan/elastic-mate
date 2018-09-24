<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Fuzziness;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
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
     * @param Analyzer|null $analyzer
     * @param int|null $cutoffFrequency
     * @param bool $isLenient
     */
    public function __construct(
        string $field,
        string $query,
        string $operator = Query::OPERATOR_OR,
        ?Fuzziness $fuzziness = null,
        ?Analyzer $analyzer = null,
        ?int $cutoffFrequency = null,
        bool $isLenient = false
    ) {
        $this->field = $field;
        $this->query = $query;
        $this->operator = $operator;
        $this->fuzziness = $fuzziness;
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
            'lenient' => $this->isLenient ? 'true' : 'false'
        ];

        if (isset($this->fuzziness)) {
            $query['fuzziness'] = $this->fuzziness->getValue();
            $query['fuzzy_transpositions'] = $this->fuzziness->isTransposable() ? 'true' : 'false';
            $query['prefix_length'] = $this->fuzziness->getPrefixLength();
            $query['max_expansions'] = $this->fuzziness->getMaxExpansions();
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
