<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class AliasProperty extends AbstractProperty
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'alias',
            'path' => $this->path
        ];
    }
}
