<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\ElisionTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class ElisionTokenFilterTest extends TestCase
{
    public function test_elision_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new ElisionTokenFilter('foo'))
            ->addArticle('l')
            ->addArticle('m');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_ELISION,
                'articles' => ['l', 'm']
            ],
            $tokenFilter->toArray()
        );
    }
}
