<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;
use stdClass;

final class MatchAllQuery implements Query
{
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'match_all' => new stdClass()
        ];
    }
}
