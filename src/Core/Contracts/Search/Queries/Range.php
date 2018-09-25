<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries;

interface Range
{
    /**
     * @return string
     */
    public function getAbbreviation(): string;

    /**
     * @return string|int
     */
    public function getValue();
}
