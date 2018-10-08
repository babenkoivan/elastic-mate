<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
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
    use HasBoost,
        HasDocValues,
        CanBeEagerGlobalOrdinals,
        IgnoresAbove,
        CanBeIndexed,
        HasIndexOptions,
        HasNorms,
        HasNullValue,
        CanBeStored,
        HasSimilarity,
        HasNormalizer,
        CanSplitQueriesOnWhitespace;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->norms = false;
        $this->indexOptions = Mapping::INDEX_OPTIONS_DOCS;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'keyword',
            'boost' => $this->boost,
            'doc_values' => $this->docValues,
            'eager_global_ordinals' => $this->eagerGlobalOrdinals,
            'ignore_above' => $this->ignoreAbove,
            'index' => $this->isIndexed,
            'index_options' => $this->indexOptions,
            'norms' => $this->norms,
            'null_value' => $this->nullValue,
            'store' => $this->isStored,
            'similarity' => $this->similarity,
            'normalizer' => $this->normalizer,
            'split_queries_on_whitespace' => $this->splitQueriesOnWhitespace
        ];
    }
}
