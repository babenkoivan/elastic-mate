<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;

final class TermsQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $values;

    /**
     * @param string $field
     * @param array $values
     */
    public function __construct(string $field, array $values)
    {
        $this->field = $field;
        $this->values = $values;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'terms' => [
                $this->field => $this->values
            ]
        ];
    }
}
