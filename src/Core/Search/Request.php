<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Sort;

final class Request implements Arrayable
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var Sort|null
     */
    private $sort;

    /**
     * @var Pagination|null
     */
    private $pagination;

    /**
     * @param Query $query
     */
    public function __construct(Query $query) {
        $this->query = $query;
    }

    /**
     * @param Sort $sort
     * @return self
     */
    public function setSort(Sort $sort): self
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param Pagination $pagination
     * @return self
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $request = [
            'query' => $this->query->toArray()
        ];

        $sort = isset($this->sort) ? $this->sort->toArray() : null;

        if (!empty($sort)) {
            $request['sort'] = $this->sort->toArray();
        }

        if (isset($this->pagination)) {
            $request['from'] = $this->pagination->getFrom();

            if (!is_null($this->pagination->getSize())) {
                $request['size'] = $this->pagination->getSize();
            }
        }

        return $request;
    }
}
