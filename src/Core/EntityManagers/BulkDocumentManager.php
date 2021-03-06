<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Content\Mutators\ContentMutator;
use BabenkoIvan\ElasticMate\Core\Contracts\Client\Client;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\DocumentManager;
use BabenkoIvan\ElasticMate\Core\Entities\Document;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Response;
use Illuminate\Support\Collection;

final class BulkDocumentManager implements DocumentManager
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function index(Index $index, Collection $documents, bool $force = false): DocumentManager
    {
        $contentMutator = new ContentMutator($index->getMapping());

        $payload = [
            'index' => $index->getName(),
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => []
        ];

        $documents->each(function (Document $document) use (&$payload, $contentMutator) {
            $payload['body'][] = [
                'index' => [
                    '_id' => $document->getId()
                ]
            ];

            $payload['body'][] = $contentMutator->toPrimitive($document->getContent());
        });

        if ($force) {
            $payload['refresh'] = true;
        }

        $this->client
            ->bulk($payload);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function delete(Index $index, Collection $documents, bool $force = false): DocumentManager
    {
        $payload = [
            'index' => $index->getName(),
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => []
        ];

        $documents->each(function (Document $document) use (&$payload) {
            $payload['body'][] = [
                'delete' => [
                    '_id' => $document->getId()
                ]
            ];
        });

        if ($force) {
            $payload['refresh'] = true;
        }

        $this->client
            ->bulk($payload);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function search(Index $index, Request $request): Response
    {
        $contentMutator = new ContentMutator($index->getMapping());

        $payload = [
            'index' => $index->getName(),
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => $request->toArray()
        ];

        $response = $this->client
            ->search($payload);

        $documents = collect($response['hits']['hits'])->map(function (array $hit) use ($contentMutator) {
            $id = $hit['_id'];
            $content = $contentMutator->fromPrimitive($hit['_source']);

            return new Document($id, $content);
        });

        $total = $response['hits']['total'] ?? 0;

        return new Response($documents, $total);
    }
}
