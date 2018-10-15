<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Tokenizers;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\Tokenizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\PathHierarchyTokenizer
 * @uses   \BabenkoIvan\ElasticMate\Core\Settings\Tokenizers\AbstractTokenizer
 */
final class PathHierarchyTokenizerTest extends TestCase
{
    public function test_path_hierarchy_tokenizer_has_correct_default_values(): void
    {
        $tokenizer = new PathHierarchyTokenizer('foo');

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_PATH_HIERARCHY,
                'delimiter' => '/',
                'buffer_size' => 1024,
                'reverse' => false,
                'skip' => 0
            ],
            $tokenizer->toArray()
        );
    }

    public function test_path_hierarchy_tokenizer_can_be_converted_to_array(): void
    {
        $tokenizer = (new PathHierarchyTokenizer('foo'))
            ->setDelimiter('-')
            ->setReplacement('/')
            ->setBufferSize(256)
            ->setReversed(true)
            ->setSkip(1);

        $this->assertSame(
            [
                'type' => Tokenizer::TYPE_PATH_HIERARCHY,
                'delimiter' => '-',
                'buffer_size' => 256,
                'reverse' => true,
                'skip' => 1,
                'replacement' => '/'
            ],
            $tokenizer->toArray()
        );
    }
}
