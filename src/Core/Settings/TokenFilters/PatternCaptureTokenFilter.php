<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanPreserveOriginal;
use Illuminate\Support\Collection;

final class PatternCaptureTokenFilter extends AbstractTokenFilter
{
    use CanPreserveOriginal;

    /**
     * @var Collection
     */
    private $patterns;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->patterns = collect();
    }

    /**
     * @param string $pattern
     * @return self
     */
    public function addPattern(string $pattern): self
    {
        $this->patterns->push($pattern);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_PATTERN_CAPTURE,
            'preserve_original' => $this->preserveOriginal,
            'patterns' => $this->patterns->values()->all()
        ];
    }
}
