<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasDelimiter
{
    /**
     * @var string
     */
    private $delimiter = '/';

    /**
     * @param string $delimiter
     * @return self
     */
    public function setDelimiter(string $delimiter): self
    {
        $this->delimiter = $delimiter;
        return $this;
    }
}
