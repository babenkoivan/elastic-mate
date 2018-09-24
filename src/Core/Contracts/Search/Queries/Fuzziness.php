<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries;

interface Fuzziness
{
    /**
     * @return bool
     */
    public function isTransposable(): bool;

    /**
     * @return string
     */
    public function getValue(): string;
}
