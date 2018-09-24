<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

interface Query extends Arrayable
{
    const OPERATOR_AND = 'and';
    const OPERATOR_OR = 'or';
}
