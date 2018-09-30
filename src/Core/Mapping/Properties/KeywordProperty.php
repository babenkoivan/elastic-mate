<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties;

final class KeywordProperty extends AbstractProperty
{
    /**
     * @var bool
     */
    private $docValues;

    /**
     * @var bool
     */
    private $store;

    /**
     * @var bool
     */
    private $index;

    /**
     * @var null|string
     */
    private $normalizer;

    /**
     * @var bool
     */
    private $eagerGlobalOrdinals;

    /**
     * @var int
     */
    private $ignoreAbove;

    /**
     * @var string
     */
    private $indexOptions;

    /**
     * @var string
     */
    private $similarity;

    /**
     * @var bool
     */
    private $norms;

    /**
     * @var bool
     */
    private $splitQueriesOnWhitespace;

    /**
     * @var mixed|null
     */
    private $nullValue;

    /**
     * @var float
     */
    private $boost;

    /**
     * @param string $name
     * @param bool $docValues
     * @param bool $store
     * @param bool $index
     * @param string|null $normalizer
     * @param bool $eagerGlobalOrdinals
     * @param int $ignoreAbove
     * @param string $indexOptions
     * @param string $similarity
     * @param bool $norms
     * @param bool $splitQueriesOnWhitespace
     * @param mixed|null $nullValue
     * @param float $boost
     */
    public function __construct(
        string $name,
        bool $docValues = true,
        bool $store = false,
        bool $index = true,
        ?string $normalizer = null,
        bool $eagerGlobalOrdinals = false,
        int $ignoreAbove = 2147483647,
        string $indexOptions = self::INDEX_OPTIONS_DOCS,
        string $similarity = self::SIMILARITY_BM25,
        bool $norms = false,
        bool $splitQueriesOnWhitespace = false,
        $nullValue = null,
        float $boost = 1.0
    ) {
        $this->name = $name;
        $this->docValues = $docValues;
        $this->store = $store;
        $this->index = $index;
        $this->normalizer = $normalizer;
        $this->eagerGlobalOrdinals = $eagerGlobalOrdinals;
        $this->ignoreAbove = $ignoreAbove;
        $this->indexOptions = $indexOptions;
        $this->similarity = $similarity;
        $this->norms = $norms;
        $this->splitQueriesOnWhitespace = $splitQueriesOnWhitespace;
        $this->nullValue = $nullValue;
        $this->boost = $boost;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => 'keyword',
            'doc_values' => $this->docValues,
            'store' => $this->store,
            'index' => $this->index,
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
