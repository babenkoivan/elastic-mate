<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanBeAppliedOnlyOnSamePosition;

final class UniqueTokenFilter extends AbstractTokenFilter
{
    use CanBeAppliedOnlyOnSamePosition;

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
