<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait CanIgnoreCase
{
    /**
     * @var bool
     */
    private $ignoreCase = false;

    /**
     * @param bool $ignoreCase
     * @return self
     */
    public function setIgnoreCase(bool $ignoreCase): self
    {
        $this->ignoreCase = $ignoreCase;
        return $this;
    }
}
