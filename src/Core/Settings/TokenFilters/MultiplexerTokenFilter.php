<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanPreserveOriginal;
use Illuminate\Support\Collection;

final class MultiplexerTokenFilter extends AbstractTokenFilter
{
    use CanPreserveOriginal;

    /**
     * @var Collection
     */
    private $filters;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->setPreserveOriginal(true);
        $this->filters = collect();
    }

    /**
     * @param string $filter
     * @return self
     */
    public function addFilter(string $filter): self
    {
        $this->filters->push($filter);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_MULTIPLEXER,
            'preserve_original' => $this->preserveOriginal
        ];

        if ($this->filters->count() > 0) {
            $tokenFilter['filters'] = $this->filters->values()->all();
        }

        return $tokenFilter;
    }
}
