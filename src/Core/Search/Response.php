<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

use Illuminate\Support\Collection;

final class Response
{
    /**
     * @var Collection
     */
    private $documents;

    /**
     * @var int
     */
    private $total;

    /**
     * @param Collection $documents
     * @param int $total
     */
    public function __construct(Collection $documents, int $total)
    {
        $this->documents = $documents;
        $this->total = $total;
    }

    /**
     * @return Collection
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
