<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class TruncateTokenFilter extends AbstractTokenFilter
{
    /**
     * @var int
     */
    private $length = 10;

    /**
     * @param int $length
     * @return self
     */
    public function setLength(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_TRUNCATE,
            'length' => $this->length
        ];
    }
}
