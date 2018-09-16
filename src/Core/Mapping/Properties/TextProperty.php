<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;

final class TextProperty extends AbstractProperty
{
    /**
     * @var Analyzer
     */
    private $analyzer;

    /**
     * @param string $name
     * @param Analyzer $analyzer
     */
    public function __construct(string $name, ?Analyzer $analyzer = null)
    {
        parent::__construct($name);
        $this->analyzer = $analyzer;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $property = [
            'type' => 'text',
        ];

        if (isset($this->analyzer)) {
            $property['analyzer'] = $this->analyzer->getName();
        }

        return $property;
    }
}
