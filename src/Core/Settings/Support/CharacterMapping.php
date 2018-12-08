<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Support;

final class CharacterMapping
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function toString(): string
    {
        return sprintf(
            '%s => %s',
            $this->key,
            $this->value
        );
    }
}
