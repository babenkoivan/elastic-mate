<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use PHPUnit\Framework\TestCase;

/**
 * @covers \BabenkoIvan\ElasticMate\Core\Search\Response
 * @uses   \BabenkoIvan\ElasticMate\Core\Content\Content
 * @uses   \BabenkoIvan\ElasticMate\Core\Entities\Document
 */
final class ResponseTest extends TestCase
{
    public function test_response_can_be_created_and_properties_can_be_received_via_getters(): void
    {
        $documents = collect([
            new Document('1', new Content(['name' => 'foo'])),
            new Document('2', new Content(['name' => 'bar'])),
        ]);

        $total = 10;

        $response = new Response($documents, $total);

        $this->assertSame($documents, $response->getDocuments());
        $this->assertSame($total, $response->getTotal());
    }
}
