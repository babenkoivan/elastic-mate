<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts;

interface Nameable
{
    /**
     * @return string
     */
    public function getName(): string;
}
