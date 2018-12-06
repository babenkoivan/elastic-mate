# Settings

Learn more about settings in [the official documentation](https://www.elastic.co/guide/en/elasticsearch/reference/current/index-modules.html).

```php
use BabenkoIvan\ElasticMate\Core\Settings\Settings;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\StandardTokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Shard;
use BabenkoIvan\ElasticMate\Core\Settings\Blocks;
use BabenkoIvan\ElasticMate\Core\Settings\Highlight;
use BabenkoIvan\ElasticMate\Core\Settings\Routing;

$settings = new Settings();

// configure analysis
$analysis = (new Analysis())
    ->addAnalyzer(new StandardAnalyzer('my_analyzer'))
    ->addTokenizer(new StandardTokenizer('my_tokenizer'));

$settings->setAnalysis($analysis);

// configure shards
$shard = (new Shard())
    ->setCheckOnStartup(Shard::CHECK_ON_STARTUP_TRUE); 

$settings->setShard($shard);

// configure blocks
$blocks = (new Blocks())
    ->setRead(true)
    ->setWrite(false);
    
$settings->setBlocks($blocks);

// configure highlighting
$highlight = (new Highlight())
    ->setMaxAnalyzedOffset(-1);

$settings->setHighlight($highlight);

// configure routing
$routing = (new Routing())
    ->setEnableAllocation(Routing::ENABLE_ALLOCATION_ALL)
    ->setEnableRebalance(Routing::ENABLE_REBALANCE_ALL);

$settings->setRouting($routing);

// configure other settings
$settings
    ->setNumberOfShards(5)
    ->setCodec(Settings::CODEC_DEFAULT)
    ->setRoutingPartitionSize(1)
    ->setNumberOfReplicas(1)
    ->setAutoExpandReplicas(Settings::AUTO_EXPAND_REPLICAS_FALSE)
    ->setRefreshInterval(1)
    ->setMaxResultWindow(10000)
    ->setMaxInnerResultWindow(100)
    ->setMaxRescoreWindow(10000)
    ->setMaxDocValueFieldsSearch(100)
    ->setMaxScriptFields(32)
    ->setMaxNgramDiff(1)
    ->setMaxShingleDiff(3)
    ->setMaxRefreshListeners(1)
    ->setMaxTermsCount(65536)
    ->setGcDeletes(60)
    ->setMaxRegexLength(1000);
```

Read more about [analysis configuration](analysis.md).
