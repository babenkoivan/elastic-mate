<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\StemmingRule;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StemmerOverrideTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Support\StemmingRule
 */
final class StemmerOverrideTokenFilterTest extends TestCase
{
    public function test_stemmer_override_token_filter_with_rule_path_can_be_converted_to_array(): void
    {
        $tokenFilter = (new StemmerOverrideTokenFilter('foo'))
            ->setRulesPath('/rules.txt');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STEMMER_OVERRIDE,
                'rules_path' => '/rules.txt'
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_stemmer_override_token_filter_with_rule_collection_can_be_converted_to_array(): void
    {
        $tokenFilter = (new StemmerOverrideTokenFilter('foo'))
            ->addRule(new StemmingRule('running', 'run'))
            ->addRule(new StemmingRule('stemmer', 'stemmer'));

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STEMMER_OVERRIDE,
                'rules' => [
                    'running => run',
                    'stemmer => stemmer'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
