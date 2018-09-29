<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class BinaryProperty extends AbstractProperty
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
     * @param string $name
     * @param bool $isDocValuesEnabled
     * @param bool $isStored
     */
    public function __construct(
        string $name,
        bool $isDocValuesEnabled = false,
        bool $isStored = false
    ) {
        $this->name = $name;
        $this->isDocValuesEnabled = $isDocValuesEnabled;
        $this->isStored = $isStored;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'binary',
            'doc_values' => $this->isDocValuesEnabled,
            'store' => $this->isStored
        ];
    }
}
