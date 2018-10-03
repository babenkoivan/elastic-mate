<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Search\Queries\Traits\HasBoost;

final class PrefixQuery implements Query
{
    use HasBoost;

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
            'value' => $this->value
        ];

        if (isset($this->boost)) {
            $query['boost'] = $this->boost;
        }

        return [
            'prefix' => [
                $this->field => $query
            ]
        ];
    }
}
