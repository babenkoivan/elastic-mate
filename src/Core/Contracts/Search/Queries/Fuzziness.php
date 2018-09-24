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
     * @return int
     */
    public function getPrefixLength(): int;

    /**
     * @return int
     */
    public function getMaxExpansions(): int;

    /**
     * @return string
     */
    public function getValue(): string;
}
