<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use Illuminate\Support\Collection;

final class KeepTypesTokenFilter extends AbstractTokenFilter
{
    /**
     * @var Collection
     */
    private $types;

    /**
     * @var string
     */
    private $mode = Analysis::MODE_INCLUDE;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->types = collect();
    }

    /**
     * @param string $type
     * @return self
     */
    public function addType(string $type): self
    {
        $this->types->push($type);
        return $this;
    }

    /**
     * @param string $mode
     * @return self
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_KEEP_TYPES,
            'mode' => $this->mode,
            'types' => $this->types->values()->all()
        ];
    }
}
