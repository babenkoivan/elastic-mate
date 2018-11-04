<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\EntityManagers;

use BabenkoIvan\ElasticMate\Core\Entities\Index;
use BabenkoIvan\ElasticMate\Core\Search\Request;
use BabenkoIvan\ElasticMate\Core\Search\Response;
use Illuminate\Support\Collection;

interface DocumentManager
{
    const DEFAULT_TYPE = '_doc';

    /**
     * @param Index $index
     * @param Collection $documents
     * @param bool $force Force immediate indexing
     * @return self
     */
    public function index(Index $index, Collection $documents, bool $force = false): self;

    /**
     * @param Index $index
     * @param Collection $documents
     * @param bool $force Force immediate deletion
     * @return self
     */
    public function delete(Index $index, Collection $documents, bool $force = false): self;

    /**
     * @param Index $index
     * @param Request $request
     * @return Response
     */
    public function search(Index $index, Request $request): Response;
}
