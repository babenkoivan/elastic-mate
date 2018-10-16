<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanPreserveOriginal;

final class AsciiFoldingTokenFilter extends AbstractTokenFilter
{
    use CanPreserveOriginal;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_ASCII_FOLDING,
            'preserve_original' => $this->preserveOriginal
        ];
    }
}
