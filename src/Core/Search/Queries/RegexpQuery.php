<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
use Illuminate\Support\Collection;

final class RegexpQuery implements Query
{
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
     * @var Collection|null
     */
    private $flags;

    /**
     * @var int|null
     */
    private $maxDeterminizedStates;

    /**
     * @var float|null
     */
    private $boost;

    /**
     * @param string $field
     * @param string $value
     * @param Collection|null $flags
     * @param int|null $maxDeterminizedStates
     * @param float|null $boost
     */
    public function __construct(
        string $field,
        string $value,
        ?Collection $flags = null,
        ?int $maxDeterminizedStates = null,
        float $boost = null
    ) {
        $this->field = $field;
        $this->value = $value;
        $this->flags = $flags;
        $this->maxDeterminizedStates = $maxDeterminizedStates;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'value' => $this->value
        ];

        if (isset($this->flags)) {
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
