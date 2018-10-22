<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use Illuminate\Support\Collection;

final class KeepTypesTokenFilter extends AbstractTokenFilter
{
    const MODE_INCLUDE = 'include';
    const MODE_EXCLUDE = 'exclude';

    /**
     * @var Collection
     */
    private $types;

    /**
     * @var string
     */
    private $mode;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->types = collect();
        $this->mode = static::MODE_INCLUDE;
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
