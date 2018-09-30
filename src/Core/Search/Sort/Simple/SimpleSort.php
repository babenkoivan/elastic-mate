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
    private $fieldSort;

    public function __construct()
    {
        $this->fieldSort = new Collection();
    }

    /**
     * @param FieldSort $fieldSort
     * @return SimpleSort
     */
    public function addFieldSort(FieldSort $fieldSort): self
    {
        $this->fieldSort->push($fieldSort);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return $this->fieldSort->map(function (FieldSort $fieldSort) {
            return $fieldSort->toArray();
        })->all();
    }
}
