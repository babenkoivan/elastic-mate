<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Support;

final class Range
{
    const TYPE_GREATER_THAN = 'gt';
    const TYPE_GREATER_THAN_OR_EQUAL = 'gte';
    const TYPE_LESS_THAN = 'lt';
    const TYPE_LESS_THAN_OR_EQUAL = 'lte';

    /**
     * @var int|string
     */
    private $value;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string|int $value
     * @param string $type
     */
    public function __construct($value, string $type)
    {

        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @return int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
