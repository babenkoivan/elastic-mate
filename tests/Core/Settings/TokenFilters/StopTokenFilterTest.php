<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\StopTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class StopTokenFilterTest extends TestCase
{
    public function test_stop_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new StopTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STOP,
                'ignore_case' => false,
                'remove_trailing' => true,
                'stopwords' => Analysis::STOP_WORDS_ENGLISH
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_stop_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new StopTokenFilter('foo'))
            ->setIgnoreCase(true)
            ->setRemoveTrailing(false)
            ->setStopWords(Analysis::STOP_WORDS_NONE)
            ->setStopWordsPath('/stopwords.txt');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_STOP,
                'ignore_case' => true,
                'remove_trailing' => false,
                'stopwords' => Analysis::STOP_WORDS_NONE,
                'stopwords_path' => '/stopwords.txt'
            ],
            $tokenFilter->toArray()
        );
    }
}
