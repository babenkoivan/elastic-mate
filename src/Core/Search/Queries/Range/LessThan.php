<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Range;

final class LessThan extends AbstractRange
{
    /**
     * @inheritdoc
     */
    public function getAbbreviation(): string
    {
        return 'lt';
    }
}
