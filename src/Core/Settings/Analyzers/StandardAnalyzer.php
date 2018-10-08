<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxTokenLength;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

class StandardAnalyzer extends AbstractAnalyzer
{
    use HasMaxTokenLength, HasStopWords, HasStopWordsPath;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->stopWords = Analysis::STOP_WORDS_NONE;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_STANDARD,
            'max_token_length' => $this->maxTokenLength,
            'stopwords' => $this->stopWords
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        }

        return $analyzer;
    }
}
