<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait CanBeLowerCased
{
    /**
     * @var bool
     */
    private $isLowerCased = true;

    /**
     * @param bool $isLowerCased
     * @return self
     */
    public function setLowerCased(bool $isLowerCased): self
    {
        $this->isLowerCased = $isLowerCased;
        return $this;
    }
}
