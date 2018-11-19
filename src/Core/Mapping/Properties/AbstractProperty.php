<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use BabenkoIvan\ElasticMate\Core\Traits\HasName;

abstract class AbstractProperty implements Property
{
    use HasName;

    /**
     * @var Mutator|null
     */
    private $mutator;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Mutator|null
     */
    public function getMutator(): ?Mutator
    {
        return $this->mutator;
    }

    /**
     * @param Mutator|null $mutator
     * @return Property
     */
    public function setMutator(Mutator $mutator): Property
    {
        $this->mutator = $mutator;
        return $this;
    }

    /**
     * @inheritdoc
     */
    abstract public function toArray(): array;
}
