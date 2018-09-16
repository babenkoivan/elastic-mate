<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Dependencies;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Client as ClientContract;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\DocumentManager;
use BabenkoIvan\ElasticMate\Infrastructure\Client\ClientFactory;
use stdClass;

trait Client
{
    /**
     * @var ClientContract
     */
    protected $client;

    /**
     * @before
     */
    public function makeClient(): void
    {
        $this->client = ClientFactory::fromConfig([
            'hosts' => [
                getenv('SCOUT_ELASTIC_HOST')
            ]
        ]);
    }

    /**
     * @after
     */
    public function dropIndices(): void
    {
        $this->deleteIndex('*');
    }

    /**
     * @param string $name
     * @param array|null $mapping
     * @param array|null $settings
     */
    protected function createIndex(string $name, ?array $mapping = null, ?array $settings = null): void
    {
        $payload = [
            'index' => $name
        ];

        if (isset($settings) || isset($mapping)) {
            $payload['body'] = [];
        }

        if (isset($settings)) {
            $payload['body']['settings'] = $settings;
        }

        if (isset($mapping)) {
            $payload['body']['mappings'] = [
                DocumentManager::DEFAULT_TYPE => $mapping
            ];
        }

        $this->client->indices()
            ->create($payload);
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function isIndexExists(string $name): bool
    {
        $payload = [
            'index' => $name
        ];

        return $this->client->indices()
            ->exists($payload);
    }

    /**
     * @param string $name
     */
    protected function deleteIndex(string $name): void
    {
        $payload = [
            'index' => $name
        ];

        $this->client->indices()
            ->delete($payload);
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getIndexSettings(string $name): array
    {
        $payload = [
            'index' => $name
        ];

        $settings = $this->client->indices()
            ->getSettings($payload);

        return array_get($settings, $name . '.settings.index');
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getIndexMapping(string $name): array
    {
        $payload = [
            'index' => $name
        ];

        $mapping = $this->client->indices()
            ->getMapping($payload);

        return array_get($mapping, $name . '.mappings._doc');
    }

    /**
     * @param string $name
     * @param array $documents ['1' => ['name' => 'foo'], '2' => ['name' => 'bar']]
     */
    protected function createIndexDocuments(string $name, array $documents): void
    {
        $payload = [
            'index' => $name,
            'type' => DocumentManager::DEFAULT_TYPE,
            'refresh' => 'true',
            'body' => []
        ];

        collect($documents)->each(function (array $content, string $id) use (&$payload) {
            $payload['body'][] = [
                'index' => [
                    '_id' => $id
                ]
            ];

            $payload['body'][] = $content;
        });

        $this->client
            ->bulk($payload);
    }

    /**
     * @param string $name
     * @return array ['1' => ['name' => 'foo'], '2' => ['name' => 'bar']]
     */
    protected function getIndexDocuments(string $name): array
    {
        $payload = [
            'index' => $name,
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => [
                'query' => [
                    'match_all' => new stdClass()
                ],
                'sort' => [
                    [
                        '_id' => 'asc'
                    ]
                ]
            ]
        ];

        $result = $this->client
            ->search($payload);

        return collect($result['hits']['hits'])->mapWithKeys(function (array $hit) {
            return [
                $hit['_id'] => $hit['_source']
            ];
        })->all();
    }
}
