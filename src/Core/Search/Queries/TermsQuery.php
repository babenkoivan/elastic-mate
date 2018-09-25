<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
use Illuminate\Support\Collection;

final class TermsQuery implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var Collection
     */
    private $values;

    /**
     * @param string $field
     * @param Collection $values
     */
    public function __construct(string $field, Collection $values)
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
                $this->field => $this->values->values()->all()
            ]
        ];
    }
}
