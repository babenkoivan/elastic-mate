<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait CanBeAppliedOnlyOnSamePosition
{
    private $onlyOnSamePosition = true;

    /**
     * @param bool $onlyOnSamePosition
     * @return self
     */
    public function setOnlyOnSamePosition(bool $onlyOnSamePosition): self
    {
        $this->onlyOnSamePosition = $onlyOnSamePosition;
        return $this;
    }
}
