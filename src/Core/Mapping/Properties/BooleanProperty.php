<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class BooleanProperty extends AbstractProperty
{
    /**
     * @var bool
     */
    private $docValues;

    /**
     * @var bool
     */
    private $store;

    /**
     * @var bool
     */
    private $index;

    /**
     * @var null
     */
    private $nullValue;

    /**
     * @var float
     */
    private $boost;

    /**
     * @param string $name
     * @param bool $docValues
     * @param bool $store
     * @param bool $index
     * @param mixed|null $nullValue
     * @param float $boost
     */
    public function __construct(
        string $name,
        bool $docValues = true,
        bool $store = false,
        bool $index = true,
        $nullValue = null,
        float $boost = 1.0
    ) {
        $this->name = $name;
        $this->docValues = $docValues;
        $this->store = $store;
        $this->index = $index;
        $this->nullValue = $nullValue;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'boolean',
            'doc_values' => $this->docValues,
            'store' => $this->store,
            'index' => $this->index,
            'null_value' => $this->nullValue,
            'boost' => $this->boost
        ];
    }
}
