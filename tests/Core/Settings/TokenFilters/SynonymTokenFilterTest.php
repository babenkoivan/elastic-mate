<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\SynonymTokenFilter
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\TokenFilters\AbstractTokenFilter
 */
final class SynonymTokenFilterTest extends TestCase
{
    public function test_synonym_token_filter_has_correct_default_values(): void
    {
        $tokenFilter = new SynonymTokenFilter('foo');

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SYNONYM,
                'expand' => true,
                'lenient' => false,
                'synonyms' => []
            ],
            $tokenFilter->toArray()
        );
    }

    public function test_synonym_token_filter_can_be_converted_to_array(): void
    {
        $tokenFilter = (new SynonymTokenFilter('foo'))
            ->setExpand(false)
            ->setLenient(true)
            ->setSynonyms('i-pod', collect(['i pod', 'ipod']))
            ->setSynonyms('universe', collect(['cosmos']));

        $this->assertSame(
            [
                'type' => TokenFilter::TYPE_SYNONYM,
                'expand' => false,
                'lenient' => true,
                'synonyms' => [
                    'i-pod, i pod, ipod',
                    'universe, cosmos'
                ]
            ],
            $tokenFilter->toArray()
        );
    }
}
