<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Support\Fuzziness;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

final class FuzzyQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

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
     * @var float|null
     */
    private $boost;

    /**
     * @param string $field
     * @param string $value
     * @param Fuzziness|null $fuzziness
     * @param int $prefixLength
     * @param int $maxExpansions
     * @param float|null $boost
     */
    public function __construct(
        string $field,
        string $value,
        ?Fuzziness $fuzziness = null,
        int $prefixLength = 0,
        int $maxExpansions = 50,
        float $boost = null
    ) {
        $this->field = $field;
        $this->value = $value;
        $this->fuzziness = $fuzziness;
        $this->prefixLength = $prefixLength;
        $this->maxExpansions = $maxExpansions;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'value' => $this->value,
            'prefix_length' => $this->prefixLength,
            'max_expansions' => $this->maxExpansions
        ];

        if (isset($this->fuzziness)) {
            $query['fuzziness'] = $this->fuzziness->toString();
            $query['transpositions'] = $this->fuzziness->isTransposable() ? 'true' : 'false';
        }

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'fuzzy' => [
                $this->field => $query
            ]
        ];
    }
}
