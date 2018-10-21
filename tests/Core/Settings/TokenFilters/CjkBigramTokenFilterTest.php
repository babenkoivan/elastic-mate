<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\CjkBigramTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class CjkBigramTokenFilterTest extends TestCase
{
    public function test_cjk_bigram_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new CjkBigramTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_CJK_BIGRAM,
                'output_unigrams' => true
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_cjk_bigram_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new CjkBigramTokenFilter('foo'))
            ->setOutputUnigrams(false)
            ->addIgnoredScript(Analysis::SCRIPT_HANGUL)
            ->addIgnoredScript(Analysis::SCRIPT_KATAKANA);

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_CJK_BIGRAM,
                'output_unigrams' => false,
                'ignored_scripts' => [
                    Analysis::SCRIPT_HANGUL,
                    Analysis::SCRIPT_KATAKANA
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
