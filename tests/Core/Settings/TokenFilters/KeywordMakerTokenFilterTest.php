<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\KeywordMakerTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class KeywordMakerTokenFilterTest extends TestCase
{
    public function test_keyword_maker_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new KeywordMakerTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEYWORD_MAKER,
                'ignore_case' => false,
                'keywords' => []
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_keyword_maker_token_filter_with_keywords_pattern_can_be_converted_to_array(): void
    {
        $tokenFilter = (new KeywordMakerTokenFilter('foo'))
            ->setIgnoreCase(true)
            ->setKeywordsPattern('\w+');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEYWORD_MAKER,
                'ignore_case' => true,
                'keywords_pattern' => '\w+'
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_keyword_maker_token_filter_with_keywords_path_can_be_converted_to_array(): void
    {
        $tokenFilter = (new KeywordMakerTokenFilter('foo'))
            ->setIgnoreCase(true)
            ->setKeywordsPath('/keywords.txt');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEYWORD_MAKER,
                'ignore_case' => true,
                'keywords_path' => '/keywords.txt'
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_keyword_maker_token_filter_with_keywords_can_be_converted_to_array(): void
    {
        $tokenFilter = (new KeywordMakerTokenFilter('foo'))
            ->setIgnoreCase(true)
            ->addKeyword('keyword1')
            ->addKeyword('keyword2');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_KEYWORD_MAKER,
                'ignore_case' => true,
                'keywords' => [
                    'keyword1',
                    'keyword2'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
