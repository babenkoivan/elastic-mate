<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Support;

use BabenkoIvan\ElasticMate\Core\Contracts\Stringable;

interface Fuzziness extends Stringable
{
    /**
     * @return bool
     */
    public function isTransposable(): bool;
}
