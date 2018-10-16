<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class LengthTokenFilter extends AbstractTokenFilter
{
    /**
     * @var int
     */
    private $min = 0;

    /**
     * @var int
     */
    private $max = 2147483647;

    /**
     * @param int $min
     * @return self
     */
    public function setMin(int $min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param int $max
     * @return self
     */
    public function setMax(int $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_LENGTH,
            'min' => $this->min,
            'max' => $this->max
        ];
    }
}
