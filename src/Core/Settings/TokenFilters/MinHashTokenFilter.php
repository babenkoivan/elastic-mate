<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\TokenFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\TokenFilter;

final class MinHashTokenFilter extends AbstractTokenFilter
{
    /**
     * @var int
     */
    private $hashCount = 1;

    /**
     * @var int
     */
    private $bucketCount = 512;

    /**
     * @var int
     */
    private $hashSetSize = 1;

    /**
     * @var bool
     */
    private $withRotation = true;

    /**
     * @param int $hashCount
     * @return MinHashTokenFilter
     */
    public function setHashCount(int $hashCount): MinHashTokenFilter
    {
        $this->hashCount = $hashCount;
        return $this;
    }

    /**
     * @param int $bucketCount
     * @return self
     */
    public function setBucketCount(int $bucketCount): self
    {
        $this->bucketCount = $bucketCount;
        return $this;
    }

    /**
     * @param int $hashSetSize
     * @return self
     */
    public function setHashSetSize(int $hashSetSize): self
    {
        $this->hashSetSize = $hashSetSize;
        return $this;
    }

    /**
     * @param bool $withRotation
     * @return self
     */
    public function setWithRotation(bool $withRotation): self
    {
        $this->withRotation = $withRotation;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'type' => TokenFilter::TYPE_MIN_HASH,
            'hash_count' => $this->hashCount,
            'bucket_count' => $this->bucketCount,
            'hash_set_size' => $this->hashSetSize,
            'with_rotation' => $this->withRotation
        ];
    }
}
