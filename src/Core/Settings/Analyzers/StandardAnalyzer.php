<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Analyzers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Analyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasMaxTokenLength;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWords;
use BabenkoIvan\ElasticMate\Core\Settings\Traits\HasStopWordsPath;

final class StandardAnalyzer extends AbstractAnalyzer
{
    use HasMaxTokenLength, HasStopWords, HasStopWordsPath;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $analyzer = [
            'type' => Analyzer::TYPE_STANDARD,
            'max_token_length' => $this->maxTokenLength
        ];

        if (isset($this->stopWordsPath)) {
            $analyzer['stopwords_path'] = $this->stopWordsPath;
        } else {
            $analyzer['stopwords'] = $this->stopWords;
        }

        return $analyzer;
    }
}
