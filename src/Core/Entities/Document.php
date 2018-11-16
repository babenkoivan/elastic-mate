<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Entities;

use BabenkoIvan\ElasticMate\Core\Content\Content;

final class Document
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Content
     */
    private $content;

    /**
     * @param string $id
     * @param Content $content
     */
    public function __construct(string $id, Content $content)
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
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }
}
