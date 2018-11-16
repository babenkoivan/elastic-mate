<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Entities\Document
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Content
 */
final class DocumentTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['1', new Content(['name' => 'foo'])],
            ['2', new Content(['name' => 'bar'])],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @testdox Document with id $id can be created and properties can be received via getters
     * @param string $id
     * @param Content $content
     */
    public function test_document_can_be_created_and_properties_can_be_received_via_getters(
        string $id,
        Content $content
    ): void {
        $document = new Document($id, $content);

        $this->assertSame($id, $document->getId());
        $this->assertInstanceOf(Content::class, $document->getContent());
        $this->assertSame($content->toArray(), $document->getContent()->toArray());
    }
}
