<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasFuzziness;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasMaxExpansions;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasPrefixLength;

final class FuzzyQuery implements Query
{
    use HasFuzziness, HasPrefixLength, HasMaxExpansions, HasBoost;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
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
            $query['transpositions'] = $this->fuzziness->isTransposable();
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
