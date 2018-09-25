<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Queries\Range;

abstract class AbstractRange implements Range
{
    /**
     * @var int|string
     */
    protected $value;

    /**
     * @param string|int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    abstract public function getAbbreviation(): string;

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }
}
