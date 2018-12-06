<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer;
use BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Settings
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Shard
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Blocks
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Highlight
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Routing
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analysis
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\AbstractAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Analyzers\StandardAnalyzer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LengthTokenFilter
 */
final class SettingsTest extends TestCase
{
    public function test_settings_has_correct_default_values(): void
    {
        $settings = new Settings();

        $this->assertSame(
            [
                'number_of_shards' => 5,
                'codec' => Settings::CODEC_DEFAULT,
                'routing_partition_size' => 1,
                'number_of_replicas' => 1,
                'auto_expand_replicas' => Settings::AUTO_EXPAND_REPLICAS_FALSE,
                'refresh_interval' => '1s',
                'max_result_window' => 10000,
                'max_inner_result_window' => 100,
                'max_rescore_window' => 10000,
                'max_docvalue_fields_search' => 100,
                'max_script_fields' => 32,
                'max_ngram_diff' => 1,
                'max_shingle_diff' => 3,
                'max_terms_count' => 65536,
                'gc_deletes' => '60s',
                'max_regex_length' => 1000
            ],
            $settings->toArray()
        );
    }

    public function test_settings_can_be_converted_to_array(): void
    {
        $shard = (new Shard())
            ->setCheckOnStartup(Shard::CHECK_ON_STARTUP_CHECKSUM);

        $blocks = (new Blocks())
            ->setReadOnly(false)
            ->setReadOnlyAllowDelete(true)
            ->setRead(false)
            ->setWrite(true)
            ->setMetadata(true);

        $highlight = (new Highlight())
            ->setMaxAnalyzedOffset(10);

        $routing = (new Routing())
            ->setEnableAllocation(Routing::ENABLE_ALLOCATION_NONE)
            ->setEnableRebalance(Routing::ENABLE_REBALANCE_PRIMARIES);

        $analysis = (new Analysis())
            ->addAnalyzer(new StandardAnalyzer('standard_analyzer'))
            ->addTokenFilter(new LengthTokenFilter('length_filter'));

        $settings = (new Settings())
            ->setNumberOfShards(10)
            ->setCodec(Settings::CODEC_BEST_COMPRESSION)
            ->setRoutingPartitionSize(2)
            ->setNumberOfReplicas(2)
            ->setAutoExpandReplicas(Settings::AUTO_EXPAND_REPLICAS_ALL)
            ->setRefreshInterval(10)
            ->setMaxResultWindow(999)
            ->setMaxInnerResultWindow(99)
            ->setMaxRescoreWindow(888)
            ->setMaxDocValueFieldsSearch(10)
            ->setMaxScriptFields(16)
            ->setMaxNgramDiff(2)
            ->setMaxShingleDiff(1)
            ->setMaxTermsCount(1024)
            ->setGcDeletes(11)
            ->setMaxRegexLength(777)
            ->setShard($shard)
            ->setBlocks($blocks)
            ->setMaxRefreshListeners(2)
            ->setHighlight($highlight)
            ->setRouting($routing)
            ->setAnalysis($analysis);

        $this->assertSame(
            [
                'number_of_shards' => 10,
                'codec' => Settings::CODEC_BEST_COMPRESSION,
                'routing_partition_size' => 2,
                'number_of_replicas' => 2,
                'auto_expand_replicas' => Settings::AUTO_EXPAND_REPLICAS_ALL,
                'refresh_interval' => '10s',
                'max_result_window' => 999,
                'max_inner_result_window' => 99,
                'max_rescore_window' => 888,
                'max_docvalue_fields_search' => 10,
                'max_script_fields' => 16,
                'max_ngram_diff' => 2,
                'max_shingle_diff' => 1,
                'max_terms_count' => 1024,
                'gc_deletes' => '11s',
                'max_regex_length' => 777,
                'shard' => $shard->toArray(),
                'blocks' => $blocks->toArray(),
                'max_refresh_listeners' => 2,
                'highlight' => $highlight->toArray(),
                'routing' => $routing->toArray(),
                'analysis' => $analysis->toArray()
            ],
            $settings->toArray()
        );
    }
}
