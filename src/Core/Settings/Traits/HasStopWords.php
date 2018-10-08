<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

use BabenkoIvan\ElasticMate\Core\Settings\Analysis;
use Illuminate\Support\Collection;
use InvalidArgumentException;

trait HasStopWords
{
    /**
     * @var Collection|string
     */
    private $stopWords = Analysis::STOP_WORDS_ENGLISH;

    /**
     * @param Collection|string $stopWords
     * @return self
     */
    public function setStopWords($stopWords): self
    {
        if ($stopWords instanceof Collection) {
            $this->stopWords = $stopWords->values()->all();
        } elseif (is_string($stopWords)) {
            $this->stopWords = $stopWords;
        } else {
            throw new InvalidArgumentException(sprintf(
                'Stop words can be either string or %s type',
                Collection::class
            ));
        }

        return $this;
    }
}
