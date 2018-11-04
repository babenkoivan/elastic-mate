<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeepTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class KeepTokenFilterTest extends TestCase
{
    public function test_keep_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new KeepTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEEP,
                'keep_words_case' => false,
                'keep_words' => []
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_keep_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new KeepTokenFilter('foo'))
            ->setKeepWordsCase(true)
            ->addKeepWord('one')
            ->addKeepWord('two');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEEP,
                'keep_words_case' => true,
                'keep_words' => [
                    'one',
                    'two'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
