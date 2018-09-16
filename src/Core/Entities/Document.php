<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use Illuminate\Support\Collection;

final class Document
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Collection
     */
    private $content;

    /**
     * @param string $id
     * @param Collection $content
     */
    public function __construct(string $id, Collection $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getContent(): Collection
    {
        return $this->content;
    }
}
