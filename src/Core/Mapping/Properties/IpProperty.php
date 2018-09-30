<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class IpProperty extends AbstractProperty
{
    /**
     * @var bool
     */
    private $isDocValuesEnabled;

    /**
     * @var bool
     */
    private $isStored;

    /**
     * @var bool
     */
    private $isIndexed;

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
     * @param bool $isDocValuesEnabled
     * @param bool $isStored
     * @param bool $isIndexed
     * @param null $nullValue
     * @param float $boost
     */
    public function __construct(
        string $name,
        bool $isDocValuesEnabled = true,
        bool $isStored = false,
        bool $isIndexed = true,
        $nullValue = null,
        float $boost = 1.0
    ) {
        $this->name = $name;
        $this->isDocValuesEnabled = $isDocValuesEnabled;
        $this->isStored = $isStored;
        $this->isIndexed = $isIndexed;
        $this->nullValue = $nullValue;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'ip',
            'doc_values' => $this->isDocValuesEnabled,
            'store' => $this->isStored,
            'index' => $this->isIndexed,
            'null_value' => $this->nullValue,
            'boost' => $this->boost
        ];
    }
}
