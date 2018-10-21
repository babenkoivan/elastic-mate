<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;

final class PatternReplaceTokenFilter extends AbstractTokenFilter
{
    use HasPattern;

    /**
     * @var string
     */
    private $replacement = ' ';

    /**
     * @param string $replacement
     * @return self
     */
    public function setReplacement(string $replacement): self
    {
        $this->replacement = $replacement;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_PATTERN_REPLACE,
            'pattern' => $this->pattern,
            'replacement' => $this->replacement
        ];
    }
}
