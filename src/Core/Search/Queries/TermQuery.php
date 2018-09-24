<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;

final class TermQuery implements Query
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
     * @var float|null
     */
    private $boost;

    /**
     * @param string $field
     * @param string $value
     * @param float|null $boost
     */
    public function __construct(string $field, string $value, float $boost = null)
    {
        $this->field = $field;
        $this->value = $value;
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

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'term' => [
                $this->field => $query
            ]
        ];
    }
}
