<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Contracts\Nameable;

interface Property extends Nameable, Arrayable
{
    /**
     * @return Mutator|null
     */
    public function getMutator(): ?Mutator;

    /**
     * @param Mutator $mutator
     * @return self
     */
    public function setMutator(Mutator $mutator): self;
}
