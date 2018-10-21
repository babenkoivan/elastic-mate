<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class LimitTokenFilter extends AbstractTokenFilter
{
    /**
     * @var int
     */
    private $maxTokenCount = 1;

    /**
     * @var bool
     */
    private $consumeAllTokens = false;

    /**
     * @param int $maxTokenCount
     * @return self
     */
    public function setMaxTokenCount(int $maxTokenCount): self
    {
        $this->maxTokenCount = $maxTokenCount;
        return $this;
    }

    /**
     * @param bool $consumeAllTokens
     * @return self
     */
    public function setConsumeAllTokens(bool $consumeAllTokens): self
    {
        $this->consumeAllTokens = $consumeAllTokens;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_LIMIT,
            'max_token_count' => $this->maxTokenCount,
            'consume_all_tokens' => $this->consumeAllTokens
        ];
    }
}
