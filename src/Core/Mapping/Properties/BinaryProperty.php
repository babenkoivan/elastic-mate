<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class BinaryProperty extends AbstractProperty
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
     * @param string $name
     * @param bool $docValues
     * @param bool $store
     */
    public function __construct(
        string $name,
        bool $docValues = false,
        bool $store = false
    ) {
        $this->name = $name;
        $this->docValues = $docValues;
        $this->store = $store;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'binary',
            'doc_values' => $this->docValues,
            'store' => $this->store
        ];
    }
}
