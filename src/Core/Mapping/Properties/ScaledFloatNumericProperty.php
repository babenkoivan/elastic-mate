<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class ScaledFloatNumericProperty extends AbstractNumericProperty
{
    /**
     * @var int
     */
    private $scalingFactor = 1;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->type = 'scaled_float';
    }

    /**
     * @param int $scalingFactor
     * @return self
     */
    public function setScalingFactor(int $scalingFactor): self
    {
        $this->scalingFactor = $scalingFactor;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $property = parent::toArray();
        $property['scaling_factor'] = $this->scalingFactor;
        return $property;
    }
}
