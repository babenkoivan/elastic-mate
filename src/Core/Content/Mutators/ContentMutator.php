<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Content\Mutators;

use BabenkoIvan\ElasticMate\Core\Content\Content;
use BabenkoIvan\ElasticMate\Core\Contracts\Content\Mutator;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;
use Illuminate\Support\Collection;

final class ContentMutator implements Mutator
{
    /**
     * @var Collection
     */
    private $mutators;

    /**
     * @param Mapping $mapping
     */
    public function __construct(Mapping $mapping)
    {
        $this->mutators = $mapping->getProperties()
            ->mapWithKeys(function (Property $property) {
                return [
                    $property->getName() => $property->getMutator()
                ];
            })->filter();
    }

    /**
     * @inheritdoc
     */
    public function toPrimitive($content)
    {
        $mutators = $this->mutators;

        return $content->mapWithKeys(function ($value, string $field) use ($mutators) {
            $mutator = $mutators->get($field);

            return [
                $field => isset($mutator) ? $mutator->toPrimitive($value) : $value
            ];
        })->all();
    }

    /**
     * @inheritdoc
     */
    public function fromPrimitive($content)
    {
        $mutators = $this->mutators;

        return (new Content($content))->mapWithKeys(function ($value, string $field) use ($mutators) {
            $mutator = $mutators->get($field);

            return [
                $field => isset($mutator) ? $mutator->fromPrimitive($value) : $value
            ];
        });
    }
}
