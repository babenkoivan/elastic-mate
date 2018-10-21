<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;
use Illuminate\Support\Collection;

final class SynonymTokenFilter extends AbstractTokenFilter
{
    /**
     * @var Collection
     */
    private $synonyms;

    /**
     * @var string
     */
    private $synonymsPath;

    /**
     * @var bool
     */
    private $expand = true;

    /**
     * @var bool
     */
    private $isLenient = false;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->synonyms = collect();
    }

    /**
     * @param string $word
     * @param Collection $synonyms
     * @return self
     */
    public function setSynonyms(string $word, Collection $synonyms): self
    {
        $this->synonyms->put($word, $synonyms);
        return $this;
    }

    /**
     * @param string $synonymsPath
     * @return self
     */
    public function setSynonymsPath(string $synonymsPath): self
    {
        $this->synonymsPath = $synonymsPath;
        return $this;
    }

    /**
     * @param bool $expand
     * @return self
     */
    public function setExpand(bool $expand): self
    {
        $this->expand = $expand;
        return $this;
    }

    /**
     * @param bool $isLenient
     * @return self
     */
    public function setLenient(bool $isLenient): self
    {
        $this->isLenient = $isLenient;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $tokenFilter = [
            'type' => TokenFilter::TYPE_SYNONYM,
            'expand' => $this->expand,
            'lenient' => $this->isLenient
        ];

        if (isset($this->synonymsPath)) {
            $tokenFilter['synonyms_path'] = $this->synonymsPath;
        } else {
            $tokenFilter['synonyms'] = $this->synonyms->map(function (Collection $synonyms, string $word) {
                return sprintf('%s, %s', $word, $synonyms->implode(', '));
            })->values()->all();
        }

        return $tokenFilter;
    }
}
