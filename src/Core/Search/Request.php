<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Query;
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
     * @param Sort|null $sort
     * @param Pagination|null $pagination
     */
    public function __construct(
        Query $query,
        ?Sort $sort = null,
        ?Pagination $pagination = null
    ) {
        $this->query = $query;
        $this->sort = $sort;
        $this->pagination = $pagination;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $request = [
            'query' => $this->query->toArray()
        ];

        if (isset($this->sort)) {
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
