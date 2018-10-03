<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;

final class WildcardQuery implements Query
{
    use HasBoost;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $wildcard;

    /**
     * @param string $field
     * @param string $wildcard
     */
    public function __construct(string $field, string $wildcard)
    {
        $this->field = $field;
        $this->wildcard = $wildcard;
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
