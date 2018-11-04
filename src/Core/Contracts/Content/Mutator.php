<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Content;

interface Mutator
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function toPrimitive($value);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function fromPrimitive($value);
}
