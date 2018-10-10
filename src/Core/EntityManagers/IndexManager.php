<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Client;
use BabenkoIvan\ElasticMate\Core\Contracts\Client\Namespaces\IndicesNamespace;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\DocumentManager;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\IndexManager as IndexManagerContract;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use UnexpectedValueException;

final class IndexManager implements IndexManagerContract
{
    /**
     * @var IndicesNamespace
     */
    private $indices;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->indices = $client->indices();
    }

    /**
     * @inheritdoc
     */
    public function exists(Index $index): bool
    {
        $payload = [
            'index' => $index->getName()
        ];

        return $this->indices
            ->exists($payload);
    }

    /**
     * @inheritdoc
     */
    public function create(Index $index): IndexManagerContract
    {
        $settings = $index->getSettings();
        $mapping = $index->getMapping();

        $payload = [
            'index' => $index->getName(),
            'body' => [
                'settings' => $settings->toArray(),
                'mappings' => [
                    DocumentManager::DEFAULT_TYPE => $mapping->toArray()
                ]
            ]
        ];

        $this->indices
            ->create($payload);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function delete(Index $index): IndexManagerContract
    {
        $payload = [
            'index' => $index->getName()
        ];

        $this->indices
            ->delete($payload);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function updateSettings(Index $index, bool $force = false): IndexManagerContract
    {
        $settings = $index->getSettings();

        $basePayload = [
            'index' => $index->getName()
        ];

        $settingsPayload = array_merge($basePayload, [
            'body' => [
                'settings' => array_except(
                    $settings->toArray(),
                    $settings::IMMUTABLE_OPTIONS
                )
            ]
        ]);

        if ($force) {
            $this->indices
                ->close($basePayload);
        }

        $this->indices
            ->putSettings($settingsPayload);

        if ($force) {
            $this->indices
                ->open($basePayload);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function updateMapping(Index $index): IndexManagerContract
    {
        $mapping = $index->getMapping();

        $payload = [
            'index' => $index->getName(),
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => [
                DocumentManager::DEFAULT_TYPE => $mapping->toArray()
            ]
        ];

        $this->indices
            ->putMapping($payload);

        return $this;
    }
}
