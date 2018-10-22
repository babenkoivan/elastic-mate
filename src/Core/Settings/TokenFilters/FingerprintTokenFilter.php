<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxOutputSize;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasSeparator;

final class FingerprintTokenFilter extends AbstractTokenFilter
{
    use HasSeparator, HasMaxOutputSize;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_FINGERPRINT,
            'separator' => $this->separator,
            'max_output_size' => $this->maxOutputSize
        ];
    }
}
