<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\LimitTokenCountTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class LimitTokenCountTokenFilterTest extends TestCase
{
    public function test_limit_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new LimitTokenCountTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_LIMIT_TOKEN_COUNT,
                'max_token_count' => 1,
                'consume_all_tokens' => false
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_limit_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new LimitTokenCountTokenFilter('foo'))
            ->setMaxTokenCount(5)
            ->setConsumeAllTokens(true);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_LIMIT_TOKEN_COUNT,
                'max_token_count' => 5,
                'consume_all_tokens' => true
            ],
            $tokenFilter->toArray()
        );
    }
}
