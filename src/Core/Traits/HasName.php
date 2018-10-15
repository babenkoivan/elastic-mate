<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Traits;

trait HasName
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }
}
