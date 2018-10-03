<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class TextProperty extends AbstractProperty
{
    /**
     * @var string
     */
    private $analyzer;

    /**
     * @param string $name
     * @param string|null $analyzer
     */
    public function __construct(string $name, string $analyzer = null)
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
            $property['analyzer'] = $this->analyzer;
        }

        return $property;
    }
}
