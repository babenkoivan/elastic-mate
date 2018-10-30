<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

final class Blocks implements Arrayable
{
    /**
     * @var bool
     */
    private $readOnly = false;

    /**
     * @var bool
     */
    private $readOnlyAllowDelete = false;

    /**
     * @var bool
     */
    private $read = false;

    /**
     * @var bool
     */
    private $write = false;

    /**
     * @var bool
     */
    private $metadata = false;

    /**
     * @param bool $readOnly
     * @return self
     */
    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;
        return $this;
    }

    /**
     * @param bool $readOnlyAllowDelete
     * @return self
     */
    public function setReadOnlyAllowDelete(bool $readOnlyAllowDelete): self
    {
        $this->readOnlyAllowDelete = $readOnlyAllowDelete;
        return $this;
    }

    /**
     * @param bool $read
     * @return self
     */
    public function setRead(bool $read): self
    {
        $this->read = $read;
        return $this;
    }

    /**
     * @param bool $write
     * @return self
     */
    public function setWrite(bool $write): self
    {
        $this->write = $write;
        return $this;
    }

    /**
     * @param bool $metadata
     * @return self
     */
    public function setMetadata(bool $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'read_only' => $this->readOnly,
            'read_only_allow_delete' => $this->readOnlyAllowDelete,
            'read' => $this->read,
            'write' => $this->write,
            'metadata' => $this->metadata
        ];
    }
}
