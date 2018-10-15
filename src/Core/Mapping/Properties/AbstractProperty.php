<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use BabenkoIvan\ElasticMate\Core\Traits\HasName;

abstract class AbstractProperty implements Property
{
    use HasName;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    abstract public function toArray(): array;
}
