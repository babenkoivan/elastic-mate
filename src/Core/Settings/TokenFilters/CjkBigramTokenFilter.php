<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanOutputUnigrams;
use Illuminate\Support\Collection;

final class CjkBigramTokenFilter extends AbstractTokenFilter
{
    use CanOutputUnigrams;

    /**
     * @var Collection
     */
    private $ignoredScripts;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->ignoredScripts = collect();
    }

    /**
     * @param string $script
     * @return self
     */
    public function addIgnoredScript(string $script): self
    {
        $this->ignoredScripts->push($script);
        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_CJK_BIGRAM,
            'output_unigrams' => $this->outputUnigrams
        ];

        if ($this->ignoredScripts->count() > 0) {
            $tokenFilter['ignored_scripts'] = $this->ignoredScripts->values()->all();
        }

        return $tokenFilter;
    }
}
