<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasFlags;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasReplacement;

final class PatternReplaceCharacterFilter extends AbstractCharacterFilter
{
    use HasPattern, HasReplacement, HasFlags;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->replacement = ' ';
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $characterFilter = [
            'type' => CharacterFilter::TYPE_PATTERN_REPLACE,
            'pattern' => $this->pattern,
            'replacement' => $this->replacement
        ];

        if (isset($this->flags)) {
            $characterFilter['flags'] = $this->flags->implode('|');
        }

        return $characterFilter;
    }
}
