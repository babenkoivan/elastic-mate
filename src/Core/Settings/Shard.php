<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

final class Shard implements Arrayable
{
    const CHECK_ON_STARTUP_TRUE = 'true';
    const CHECK_ON_STARTUP_FALSE = 'false';
    const CHECK_ON_STARTUP_CHECKSUM = 'checksum';
    const CHECK_ON_STARTUP_FIX = 'fix';

    /**
     * @var string
     */
    private $checkOnStartup = self::CHECK_ON_STARTUP_FALSE;

    /**
     * @param string $checkOnStartup
     * @return self
     */
    public function setCheckOnStartup(string $checkOnStartup): self
    {
        $this->checkOnStartup = $checkOnStartup;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'check_on_startup' => $this->checkOnStartup
        ];
    }
}
