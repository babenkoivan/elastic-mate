<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

final class Highlight implements Arrayable
{
    /**
     * @var int
     */
    private $maxAnalyzedOffset = -1;

    /**
     * @param int $maxAnalyzedOffset
     * @return self
     */
    public function setMaxAnalyzedOffset(int $maxAnalyzedOffset): self
    {
        $this->maxAnalyzedOffset = $maxAnalyzedOffset;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'max_analyzed_offset' => $this->maxAnalyzedOffset
        ];
    }
}
