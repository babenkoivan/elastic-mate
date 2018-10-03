<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

trait HasOperator
{
    /**
     * @var string
     */
    private $operator = Query::OPERATOR_OR;

    /**
     * @param string $operator
     * @return self
     */
    public function setOperator(string $operator): self
    {
        $this->operator = $operator;
        return $this;
    }
}
