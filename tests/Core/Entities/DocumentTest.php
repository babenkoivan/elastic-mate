<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Entities\Document
 */
class DocumentTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['1', collect(['name' => 'foo'])],
            ['2', collect(['name' => 'bar'])],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox document with id $id can be created and properties can be received via getters
     * @param string $id
     * @param Collection $content
     */
    public function test_document_can_be_created_and_properties_can_be_received_via_getters(
        string $id,
        Collection $content
    ): void {
        $document = new Document($id, $content);

        $this->assertSame($id, $document->getId());
        $this->assertInstanceOf(Collection::class, $document->getContent());
        $this->assertSame($content->toArray(), $document->getContent()->toArray());
    }
}
