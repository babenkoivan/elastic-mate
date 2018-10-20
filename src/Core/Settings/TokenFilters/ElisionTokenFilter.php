<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use Illuminate\Support\Collection;

final class ElisionTokenFilter extends AbstractTokenFilter
{
    /**
     * @var Collection
     */
    private $articles;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->articles = collect();
    }

    /**
     * @param string $article
     * @return self
     */
    public function addArticle(string $article): self
    {
        $this->articles->push($article);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_ELISION,
            'articles' => $this->articles->values()->all()
        ];
    }
}
