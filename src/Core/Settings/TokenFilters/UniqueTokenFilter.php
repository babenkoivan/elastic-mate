<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class UniqueTokenFilter extends AbstractTokenFilter
{
    /**
     * @var bool
     */
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

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_UNIQUE,
            'only_on_same_position' => $this->onlyOnSamePosition
        ];
    }
}
