<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;

abstract class AbstractProperty implements Property
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    abstract public function toArray(): array;
}
