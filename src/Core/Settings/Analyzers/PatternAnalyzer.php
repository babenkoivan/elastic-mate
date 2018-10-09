<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\CanBeLowerCased;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasFlags;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasPattern;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

class PatternAnalyzer extends AbstractAnalyzer
{
    use HasPattern,
        HasFlags,
        CanBeLowerCased,
        HasStopWords,
        HasStopWordsPath;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_PATTERN,
            'pattern' => $this->pattern,
            'lowercase' => $this->isLowerCased,
            'stopwords' => $this->stopWords
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        }

        if (isset($this->flags)) {
            $analyzer['flags'] = $this->flags->implode('|');
        }

        return $analyzer;
    }
}
