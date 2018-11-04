<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use Illuminate\Support\Collection;

final class HtmlStripCharacterFilter extends AbstractCharacterFilter
{
    /**
     * @var Collection
     */
    private $escapedTags;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->escapedTags = collect();
    }

    /**
     * @param string $escapedTag
     * @return self
     */
    public function addEscapedTag(string $escapedTag): self
    {
        $this->escapedTags->push($escapedTag);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => CharacterFilter::TYPE_HTML_STRIP,
            'escaped_tags' => $this->escapedTags->values()->all()
        ];
    }
}
