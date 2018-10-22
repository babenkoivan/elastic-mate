<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\MinHashTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class MinHashTokenFilterTest extends TestCase
{
    public function test_min_hash_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new MinHashTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_MIN_HASH,
                'hash_count' => 1,
                'bucket_count' => 512,
                'hash_set_size' => 1,
                'with_rotation' => true
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_min_hash_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new MinHashTokenFilter('foo'))
            ->setHashCount(10)
            ->setBucketCount(1024)
            ->setHashSetSize(5)
            ->setWithRotation(false);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_MIN_HASH,
                'hash_count' => 10,
                'bucket_count' => 1024,
                'hash_set_size' => 5,
                'with_rotation' => false
            ],
            $tokenFilter->toArray()
        );
    }
}
