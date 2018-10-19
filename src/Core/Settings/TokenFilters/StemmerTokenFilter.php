<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasLanguage;

final class StemmerTokenFilter extends AbstractTokenFilter
{
    use HasLanguage;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_STEMMER,
            'name' => $this->language
        ];
    }
}
