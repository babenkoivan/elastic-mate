<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Infrastructure\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Contracts\Client\Client;
use BabenkoIvan\ElasticMate\Core\Contracts\Client\Namespaces\IndicesNamespace;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\DocumentManager;
use BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers\IndexManager as IndexManagerContract;
use BabenkoIvan\ElasticMate\Core\Entities\Index;
use UnexpectedValueException;

class IndexManager implements IndexManagerContract
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
        $settings = $index->getSettings() ? $index->getSettings()->toArray() : [];
        $mapping = $index->getMapping() ? $index->getMapping()->toArray() : [];

        $payload = [
            'index' => $index->getName()
        ];

        if (!empty($settings) || !empty($mapping)) {
            $payload['body'] = [];
        }

        if (!empty($settings)) {
            $payload['body']['settings'] = $settings;
        }

        if (!empty($mapping)) {
            $payload['body']['mappings'] = [
                DocumentManager::DEFAULT_TYPE => $mapping
            ];
        }

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
        $settings = $index->getSettings() ? $index->getSettings()->toArray() : [];

        if (empty($settings)) {
            throw new UnexpectedValueException(sprintf(
                '%s settings are not specified',
                $index->getName()
            ));
        }

        $basePayload = [
            'index' => $index->getName()
        ];

        $settingsPayload = array_merge($basePayload, [
            'body' => [
                'settings' => $settings
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
        $mapping = $index->getMapping() ? $index->getMapping()->toArray() : [];

        if (empty($mapping)) {
            throw new UnexpectedValueException(sprintf(
                '%s mapping is not specified',
                $index->getName()
            ));
        }

        $payload = [
            'index' => $index->getName(),
            'type' => DocumentManager::DEFAULT_TYPE,
            'body' => [
                DocumentManager::DEFAULT_TYPE => $mapping
            ]
        ];

        $this->indices
            ->putMapping($payload);

        return $this;
    }
}
