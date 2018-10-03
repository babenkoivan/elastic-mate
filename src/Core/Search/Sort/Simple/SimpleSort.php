<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Sort\Simple;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Sort;
use Illuminate\Support\Collection;

final class SimpleSort implements Sort
{
    /**
     * @var Collection
     */
    private $fieldSorts;

    /**
     * @param Collection $fieldSorts
     */
    public function __construct(Collection $fieldSorts)
    {
        $this->fieldSorts = $fieldSorts;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return $this->fieldSorts->map(function (FieldSort $fieldSort) {
            return $fieldSort->toArray();
        })->all();
    }
}
