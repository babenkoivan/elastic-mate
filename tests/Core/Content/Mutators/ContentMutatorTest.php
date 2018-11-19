<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Mutators;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\TextProperty
 */
final class ContentMutatorTest extends TestCase
{
    /**
     * @var Mapping
     */
    private $mapping;

    public function test_content_mutator_can_convert_content_object_to_array(): void
    {
        $mutator = new ContentMutator($this->mapping);

        $content = new Content([
            'foo' => '#foo_text#',
            'bar' => '#bar_text#'
        ]);

        $this->assertSame(
            [
                'foo' => '#foo_text#',
                'bar' => 'bar_text'
            ],
            $mutator->toPrimitive($content)
        );
    }

    public function test_content_mutator_can_convert_array_to_content_object(): void
    {
        $mutator = new ContentMutator($this->mapping);

        $content = $mutator->fromPrimitive([
            'foo' => 'foo_text',
            'bar' => 'bar_text'
        ]);

        $this->assertEquals(
            new Content([
                'foo' => 'foo_text',
                'bar' => '#bar_text#'
            ]),
            $content
        );
    }

    protected function setUp()
    {
        $textMutator = new class implements Mutator
        {
            public function toPrimitive($value)
            {
                return trim($value, '#');
            }

            public function fromPrimitive($value)
            {
                return sprintf('#%s#', $value);
            }
        };

        $this->mapping = (new Mapping())
            ->addProperty(new TextProperty('foo'))
            ->addProperty((new TextProperty('bar'))->setMutator($textMutator));
    }
}
