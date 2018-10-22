<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\StemmingRule;
use Illuminate\Support\Collection;

final class StemmerOverrideTokenFilter extends AbstractTokenFilter
{
    /**
     * @var Collection
     */
    private $rules;

    /**
     * @var string
     */
    private $rulesPath;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->rules = collect();
    }

    /**
     * @param StemmingRule $rule
     * @return self
     */
    public function addRule(StemmingRule $rule): self
    {
        $this->rules->push($rule);
        return $this;
    }

    /**
     * @param string $rulesPath
     * @return self
     */
    public function setRulesPath(string $rulesPath): self
    {
        $this->rulesPath = $rulesPath;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_STEMMER_OVERRIDE
        ];

        if (isset($this->rulesPath)) {
            $tokenFilter['rules_path'] = $this->rulesPath;
        } else {
            $tokenFilter['rules'] = $this->rules->map(function(StemmingRule $rule) {
                return $rule->toString();
            })->values()->all();
        }

        return $tokenFilter;
    }
}
