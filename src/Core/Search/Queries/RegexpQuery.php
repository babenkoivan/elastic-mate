<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasMaxDeterminizedStates;
use Illuminate\Support\Collection;

final class RegexpQuery implements Query
{
    use HasBoost, HasMaxDeterminizedStates;

    const FLAG_ALL = 'ALL';
    const FLAG_ANYSTRING = 'ANYSTRING';
    const FLAG_COMPLEMENT = 'COMPLEMENT';
    const FLAG_EMPTY = 'EMPTY';
    const FLAG_INTERSECTION = 'INTERSECTION';
    const FLAG_INTERVAL = 'INTERVAL';
    const FLAG_NONE = 'NONE';

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

    /**
     * @var Collection
     */
    private $flags;

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
        $this->flags = collect();
    }

    /**
     * @param string $flag
     * @return self
     */
    public function addFlag(string $flag): self
    {
        $this->flags->push($flag);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'value' => $this->value
        ];

        if ($this->flags->count() > 0) {
            $query['flags'] = $this->flags->implode('|');
        }

        if (isset($this->maxDeterminizedStates)) {
            $query['max_determinized_states'] = $this->maxDeterminizedStates;
        }

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'regexp' => [
                $this->field => $query
            ]
        ];
    }
}
