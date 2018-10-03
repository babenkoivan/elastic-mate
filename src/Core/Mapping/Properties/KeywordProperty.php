<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeEagerGlobalOrdinals;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeIndexed;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanBeStored;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\CanSplitQueriesOnWhitespace;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasBoost;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasDocValues;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasIndexOptions;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNormalizer;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNorms;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasNullValue;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\HasSimilarity;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits\IgnoresAbove;

final class KeywordProperty extends AbstractProperty
{
    use HasDocValues,
        CanBeStored,
        CanBeIndexed,
        HasNormalizer,
        CanBeEagerGlobalOrdinals,
        IgnoresAbove,
        HasIndexOptions,
        HasNorms,
        HasSimilarity,
        CanSplitQueriesOnWhitespace,
        HasNullValue,
        HasBoost;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'keyword',
            'doc_values' => $this->docValues,
            'store' => $this->isStored,
            'index' => $this->isIndexed,
            'normalizer' => $this->normalizer,
            'eager_global_ordinals' => $this->eagerGlobalOrdinals,
            'ignore_above' => $this->ignoreAbove,
            'index_options' => $this->indexOptions,
            'similarity' => $this->similarity,
            'norms' => $this->norms,
            'split_queries_on_whitespace' => $this->splitQueriesOnWhitespace,
            'null_value' => $this->nullValue,
            'boost' => $this->boost
        ];
    }
}
