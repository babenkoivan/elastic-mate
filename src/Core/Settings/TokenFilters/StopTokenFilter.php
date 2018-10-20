<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanIgnoreCase;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

final class StopTokenFilter extends AbstractTokenFilter
{
    use HasStopWords, HasStopWordsPath, CanIgnoreCase;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->setStopWords(Analysis::STOP_WORDS_ENGLISH);
    }

    /**
     * @var bool
     */
    private $removeTrailing = true;

    /**
     * @param bool $removeTrailing
     * @return self
     */
    public function setRemoveTrailing(bool $removeTrailing): self
    {
        $this->removeTrailing = $removeTrailing;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_STOP,
            'ignore_case' => $this->ignoreCase,
            'remove_trailing' => $this->removeTrailing,
            'stopwords' => $this->stopWords
        ];

        if (isset($this->stopWordsPath)) {
            $tokenFilter['stopwords_path'] = $this->stopWordsPath;
        }

        return $tokenFilter;
    }
}
