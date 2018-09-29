<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class BooleanProperty extends AbstractProperty
{
    /**
     * @var float
     */
    private $boost;

    /**
     * @var bool
     */
    private $isDocValuesEnabled;

    /**
     * @var bool
     */
    private $isIndexed;

    /**
     * @var null
     */
    private $nullValue;

    /**
     * @var bool
     */
    private $isStored;

    /**
     * @param string $name
     * @param float $boost
     * @param bool $isDocValuesEnabled
     * @param bool $isIndexed
     * @param mixed|null $nullValue
     * @param bool $isStored
     */
    public function __construct(
        string $name,
        float $boost = 1.0,
        bool $isDocValuesEnabled = true,
        bool $isIndexed = true,
        $nullValue = null,
        bool $isStored = false
    ) {
        $this->name = $name;
        $this->boost = $boost;
        $this->isDocValuesEnabled = $isDocValuesEnabled;
        $this->isIndexed = $isIndexed;
        $this->nullValue = $nullValue;
        $this->isStored = $isStored;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'boolean',
            'boost' => $this->boost,
            'doc_values' => $this->isDocValuesEnabled,
            'index' => $this->isIndexed,
            'null_value' => $this->nullValue,
            'store' => $this->isStored
        ];
    }
}
