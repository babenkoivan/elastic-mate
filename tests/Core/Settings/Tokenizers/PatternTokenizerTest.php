<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\PatternTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class PatternTokenizerTest extends TestCase
{
    public function test_pattern_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new PatternTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_PATTERN,
                'pattern' => '\W+',
                'group' => -1
            ],
            $tokenizer->toArray()
        );
    }

    public function test_pattern_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new PatternTokenizer('foo'))
            ->setPattern('((?:\\"|[^"]|\\")*)')
            ->addFlag(Analysis::REGEXP_FLAG_CASE_INSENSITIVE)
            ->addFlag(Analysis::REGEXP_FLAG_DOTALL)
            ->setGroup(1);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_PATTERN,
                'pattern' => '((?:\\"|[^"]|\\")*)',
                'group' => 1,
                'flags' => sprintf('%s|%s', Analysis::REGEXP_FLAG_CASE_INSENSITIVE, Analysis::REGEXP_FLAG_DOTALL)
            ],
            $tokenizer->toArray()
        );
    }
}
