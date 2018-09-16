<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search;

final class Pagination
{
    /**
     * @var int
     */
    private $from;

    /**
     * @var int|null
     */
    private $size;

    /**
     * @param int $from
     * @param int|null $size
     */
    public function __construct(int $from, ?int $size = null)
    {
        $this->from = $from;
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this->size;
    }
}
