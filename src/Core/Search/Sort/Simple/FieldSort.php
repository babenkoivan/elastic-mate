<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Sort\Simple;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use InvalidArgumentException;

final class FieldSort implements Arrayable
{
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $order;

    /**
     * @param string $field
     * @param string $order
     */
    public function __construct(string $field, string $order = self::ORDER_ASC)
    {
        $order = strtolower($order);

        if ($order != static::ORDER_ASC && $order != static::ORDER_DESC) {
            throw new InvalidArgumentException(sprintf(
                'Unsupported order type %s',
                $order
            ));
        }

        $this->field = $field;
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            $this->field => $this->order
        ];
    }
}
