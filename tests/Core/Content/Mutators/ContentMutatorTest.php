<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Mutators;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Mapping
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\AbstractProperty
 * @uses   \BabenkoIvan\ElasticMate\Core\Mapping\Properties\DateProperty
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
            'foo' => '2018-12-15 10:50:00',
            'bar' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2018-12-15 10:50:00')
        ]);

        $this->assertSame(
            [
                'foo' => '2018-12-15 10:50:00',
                'bar' => '2018-12-15 10:50:00'
            ],
            $mutator->toPrimitive($content)
        );
    }

    public function test_content_mutator_can_convert_array_to_content_object(): void
    {
        $mutator = new ContentMutator($this->mapping);

        $content = $mutator->fromPrimitive([
            'foo' => '2018-12-15 10:50:00',
            'bar' => '2018-12-15 10:50:00'
        ]);

        $this->assertEquals(
            new Content([
                'foo' => '2018-12-15 10:50:00',
                'bar' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2018-12-15 10:50:00')
            ]),
            $content
        );
    }

    protected function setUp()
    {
        $dateTimeMutator = new class ('Y-m-d H:i:s') implements Mutator
        {
            /**
             * @var string
             */
            private $format;

            /**
             * @param string $format
             */
            public function __construct(string $format)
            {
                $this->format = $format;
            }

            /**
             * @param DateTimeImmutable $value
             * @return string
             */
            public function toPrimitive($value)
            {
                return $value->format($this->format);
            }

            /**
             * @param string $value
             * @return DateTimeImmutable
             */
            public function fromPrimitive($value)
            {
                return DateTimeImmutable::createFromFormat($this->format, $value);
            }
        };

        $this->mapping = (new Mapping())
            ->addProperty(
                (new DateProperty('foo'))
                    ->setFormat('yyyy-MM-dd HH:mm:ss')
            )
            ->addProperty(
                (new DateProperty('bar'))
                    ->setFormat('yyyy-MM-dd HH:mm:ss')
                    ->setMutator($dateTimeMutator)
            );
    }
}
