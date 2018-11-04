<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanUseDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;

final class BinaryProperty extends AbstractProperty
{
    use CanUseDocValues, CanBeStored;

    /**
     * @param string $name
     */
    public function __construct(string $name) {
        parent::__construct($name);
        $this->setDocValues(false);
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
