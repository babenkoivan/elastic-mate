<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

final class WildcardQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $wildcard;

    /**
     * @var float|null
     */
    private $boost;

    /**
     * @param string $field
     * @param string $wildcard
     * @param float $boost
     */
    public function __construct(string $field, string $wildcard, float $boost = null)
    {
        $this->field = $field;
        $this->wildcard = $wildcard;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $query = [
            'wildcard' => $this->wildcard
        ];

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'wildcard' => [
                $this->field => $query
            ]
        ];
    }
}
