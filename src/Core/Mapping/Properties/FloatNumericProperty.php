<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class FloatNumericProperty extends AbstractNumericProperty
{
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->type = 'float';
    }
}
