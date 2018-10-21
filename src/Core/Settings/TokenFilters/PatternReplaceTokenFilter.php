<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasReplacement;

final class PatternReplaceTokenFilter extends AbstractTokenFilter
{
    use HasPattern, HasReplacement;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->setReplacement(' ');
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
