<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\FingerprintTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class FingerprintTokenFilterTest extends TestCase
{
    public function test_fingerprint_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new FingerprintTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_FINGERPRINT,
                'separator' => ' ',
                'max_output_size' => 255
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_fingerprint_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new FingerprintTokenFilter('foo'))
            ->setSeparator('-')
            ->setMaxOutputSize(128);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_FINGERPRINT,
                'separator' => '-',
                'max_output_size' => 128
            ],
            $tokenFilter->toArray()
        );
    }
}
