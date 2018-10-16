<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait CanPreserveOriginal
{
    /**
     * @var bool
     */
    private $preserveOriginal = false;

    /**
     * @param bool $preserveOriginal
     * @return self
     */
    public function setPreserveOriginal(bool $preserveOriginal): self
    {
        $this->preserveOriginal = $preserveOriginal;
        return $this;
    }
}
