<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Search\Query;

trait HasValidationMethod
{
    /**
     * @var string
     */
    private $validationMethod = Query::VALIDATION_METHOD_STRICT;

    /**
     * @param string $validationMethod
     * @return self
     */
    public function setValidationMethod(string $validationMethod): self
    {
        $this->validationMethod = $validationMethod;
        return $this;
    }
}
