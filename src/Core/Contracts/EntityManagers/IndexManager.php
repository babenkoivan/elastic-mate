<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Entities\Index;

interface IndexManager
{
    /**
     * @param Index $index
     * @return bool
     */
    public function exists(Index $index): bool;

    /**
     * @param Index $index
     * @return self
     */
    public function create(Index $index): self;

    /**
     * @param Index $index
     * @return self
     */
    public function delete(Index $index): self;

    /**
     * @param Index $index
     * @param bool $force The force flag will cause index closing and reopening after update.
     * @return self
     */
    public function updateSettings(Index $index, bool $force = false): self;

    /**
     * @param Index $index
     * @return self
     */
    public function updateMapping(Index $index): self;
}
