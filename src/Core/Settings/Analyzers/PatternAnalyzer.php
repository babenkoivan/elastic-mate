<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasFlags;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

final class PatternAnalyzer extends AbstractAnalyzer
{
    use HasPattern,
        HasFlags,
        HasStopWords,
        HasStopWordsPath;

    /**
     * @var bool
     */
    private $isLowerCased = true;

    /**
     * @param bool $isLowerCased
     * @return self
     */
    public function setLowerCased(bool $isLowerCased): self
    {
        $this->isLowerCased = $isLowerCased;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_PATTERN,
            'pattern' => $this->pattern,
            'lowercase' => $this->isLowerCased
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        } else {
            $analyzer['stopwords'] = $this->stopWords;
        }

        if (isset($this->flags)) {
            $analyzer['flags'] = $this->flags->implode('|');
        }

        return $analyzer;
    }
}
