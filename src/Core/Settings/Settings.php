<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use InvalidArgumentException;

class Settings implements Arrayable
{
    const IMMUTABLE_OPTIONS = [
        'number_of_shards',
        'routing_partition_size'
    ];

    const CODEC_DEFAULT = 'default';
    const CODEC_BEST_COMPRESSION = 'best_compression';

    const AUTO_EXPAND_REPLICAS_FALSE = 'false';
    const AUTO_EXPAND_REPLICAS_ALL = 'all';

    /**
     * @var int
     */
    private $numberOfShards = 5;

    /**
     * @var Analysis|null
     */
    private $analysis;

    /**
     * @var Shard|null
     */
    private $shard;

    /**
     * @var string
     */
    private $codec = self::CODEC_DEFAULT;

    /**
     * @var int
     */
    private $routingPartitionSize = 1;

    /**
     * @var int
     */
    private $numberOfReplicas = 1;

    /**
     * @var string
     */
    private $autoExpandReplicas = self::AUTO_EXPAND_REPLICAS_FALSE;

    /**
     * @var string
     */
    private $refreshInterval = '1s';

    /**
     * @var int
     */
    private $maxResultWindow = 10000;

    /**
     * @var int
     */
    private $maxInnerResultWindow = 100;

    /**
     * @var int
     */
    private $maxRescoreWindow = 10000;

    /**
     * @var int
     */
    private $maxDocValueFieldsSearch = 100;

    /**
     * @var int
     */
    private $maxScriptFields = 32;

    /**
     * @var int
     */
    private $maxNgramDiff = 1;

    /**
     * @var int
     */
    private $maxShingleDiff = 3;

    /**
     * @var Blocks|null
     */
    private $blocks;

    /**
     * @var int|null
     */
    private $maxRefreshListeners;

    /**
     * @var Highlight|null
     */
    private $highlight;

    /**
     * @var int
     */
    private $maxTermsCount = 65536;

    /**
     * @var Routing|null
     */
    private $routing;

    /**
     * @var string
     */
    private $gcDeletes = '60s';

    /**
     * @var int
     */
    private $maxRegexLength = 1000;

    /**
     * @param int $numberOfShards
     * @return self
     */
    public function setNumberOfShards(int $numberOfShards): self
    {
        $this->numberOfShards = $numberOfShards;
        return $this;
    }

    /**
     * @param Analysis $analysis
     * @return Settings
     */
    public function setAnalysis(Analysis $analysis): self
    {
        $this->analysis = $analysis;
        return $this;
    }

    /**
     * @param Shard $shard
     * @return self
     */
    public function setShard(Shard $shard): self
    {
        $this->shard = $shard;
        return $this;
    }

    /**
     * @param string $codec
     * @return self
     */
    public function setCodec(string $codec): self
    {
        $this->codec = $codec;
        return $this;
    }

    /**
     * @param int $routingPartitionSize
     * @return self
     */
    public function setRoutingPartitionSize(int $routingPartitionSize): self
    {
        $this->routingPartitionSize = $routingPartitionSize;
        return $this;
    }

    /**
     * @param int $numberOfReplicas
     * @return self
     */
    public function setNumberOfReplicas(int $numberOfReplicas): self
    {
        $this->numberOfReplicas = $numberOfReplicas;
        return $this;
    }

    /**
     * @param string $autoExpandReplicas
     * @return self
     */
    public function setAutoExpandReplicas(string $autoExpandReplicas): self
    {
        $this->autoExpandReplicas = $autoExpandReplicas;
        return $this;
    }

    /**
     * @param string $refreshInterval
     * @return self
     */
    public function setRefreshInterval(string $refreshInterval): self
    {
        $this->refreshInterval = $refreshInterval;
        return $this;
    }

    /**
     * @param int $maxResultWindow
     * @return self
     */
    public function setMaxResultWindow(int $maxResultWindow): self
    {
        $this->maxResultWindow = $maxResultWindow;
        return $this;
    }

    /**
     * @param int $maxInnerResultWindow
     * @return self
     */
    public function setMaxInnerResultWindow(int $maxInnerResultWindow): self
    {
        $this->maxInnerResultWindow = $maxInnerResultWindow;
        return $this;
    }

    /**
     * @param int $maxRescoreWindow
     * @return self
     */
    public function setMaxRescoreWindow(int $maxRescoreWindow): self
    {
        $this->maxRescoreWindow = $maxRescoreWindow;
        return $this;
    }

    /**
     * @param int $maxDocValueFieldsSearch
     * @return self
     */
    public function setMaxDocValueFieldsSearch(int $maxDocValueFieldsSearch): self
    {
        $this->maxDocValueFieldsSearch = $maxDocValueFieldsSearch;
        return $this;
    }

    /**
     * @param int $maxScriptFields
     * @return self
     */
    public function setMaxScriptFields(int $maxScriptFields): self
    {
        $this->maxScriptFields = $maxScriptFields;
        return $this;
    }

    /**
     * @param int $maxNgramDiff
     * @return self
     */
    public function setMaxNgramDiff(int $maxNgramDiff): self
    {
        $this->maxNgramDiff = $maxNgramDiff;
        return $this;
    }

    /**
     * @param int $maxShingleDiff
     * @return self
     */
    public function setMaxShingleDiff(int $maxShingleDiff): self
    {
        $this->maxShingleDiff = $maxShingleDiff;
        return $this;
    }

    /**
     * @param Blocks $blocks
     * @return self
     */
    public function setBlocks(Blocks $blocks): self
    {
        $this->blocks = $blocks;
        return $this;
    }

    /**
     * @param int $maxRefreshListeners
     * @return self
     */
    public function setMaxRefreshListeners(int $maxRefreshListeners): self
    {
        $this->maxRefreshListeners = $maxRefreshListeners;
        return $this;
    }

    /**
     * @param Highlight $highlight
     * @return self
     */
    public function setHighlight(Highlight $highlight): self
    {
        $this->highlight = $highlight;
        return $this;
    }

    /**
     * @param int $maxTermsCount
     * @return self
     */
    public function setMaxTermsCount(int $maxTermsCount): self
    {
        $this->maxTermsCount = $maxTermsCount;
        return $this;
    }

    /**
     * @param Routing $routing
     * @return self
     */
    public function setRouting(Routing $routing): self
    {
        $this->routing = $routing;
        return $this;
    }

    /**
     * @param string $gcDeletes
     * @return Settings
     */
    public function setGcDeletes(string $gcDeletes): Settings
    {
        $this->gcDeletes = $gcDeletes;
        return $this;
    }

    /**
     * @param int $maxRegexLength
     * @return self
     */
    public function setMaxRegexLength(int $maxRegexLength): self
    {
        $this->maxRegexLength = $maxRegexLength;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $settings = [
            'number_of_shards' => $this->numberOfShards,
            'codec' => $this->codec,
            'routing_partition_size' => $this->routingPartitionSize,
            'number_of_replicas' => $this->numberOfReplicas,
            'auto_expand_replicas' => $this->autoExpandReplicas,
            'refresh_interval' => $this->refreshInterval,
            'max_result_window' => $this->maxResultWindow,
            'max_inner_result_window' => $this->maxInnerResultWindow,
            'max_rescore_window' => $this->maxRescoreWindow,
            'max_docvalue_fields_search' => $this->maxDocValueFieldsSearch,
            'max_script_fields' => $this->maxScriptFields,
            'max_ngram_diff' => $this->maxNgramDiff,
            'max_shingle_diff' => $this->maxShingleDiff,
            'max_terms_count' => $this->maxTermsCount,
            'gc_deletes' => $this->gcDeletes,
            'max_regex_length' => $this->maxRegexLength
        ];

        if (isset($this->shard)) {
            $settings['shard'] = $this->shard->toArray();
        }

        if (isset($this->blocks)) {
            $settings['blocks'] = $this->blocks->toArray();
        }

        if (isset($this->maxRefreshListeners)) {
            $settings['max_refresh_listeners'] = $this->maxRefreshListeners;
        }

        if (isset($this->highlight)) {
            $settings['highlight'] = $this->highlight->toArray();
        }

        if (isset($this->routing)) {
            $settings['routing'] = $this->routing->toArray();
        }

        if (isset($this->analysis)) {
            $settings['analysis'] = $this->analysis->toArray();
        }

        return $settings;
    }
}
