<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Contracts\Search;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;

interface Query extends Arrayable
{
    const OPERATOR_AND = 'and';
    const OPERATOR_OR = 'or';

    const REGEXP_FLAG_ALL = 'ALL';
    const REGEXP_FLAG_ANYSTRING = 'ANYSTRING';
    const REGEXP_FLAG_COMPLEMENT = 'COMPLEMENT';
    const REGEXP_FLAG_EMPTY = 'EMPTY';
    const REGEXP_FLAG_INTERSECTION = 'INTERSECTION';
    const REGEXP_FLAG_INTERVAL = 'INTERVAL';
    const REGEXP_FLAG_NONE = 'NONE';

    const RELATION_WITHIN = 'WITHIN';
    const RELATION_CONTAINS = 'CONTAINS';
    const RELATION_INTERSECTS = 'INTERSECTS';

    const VALIDATION_METHOD_IGNORE_MALFORMED = 'IGNORE_MALFORMED';
    const VALIDATION_METHOD_COERCE = 'COERCE';
    const VALIDATION_METHOD_STRICT = 'STRICT';

    const EXECUTION_TYPE_MEMORY = 'memory';
    const EXECUTION_TYPE_INDEXED = 'indexed';

    const DISTANCE_TYPE_ARC = 'arc';
    const DISTANCE_TYPE_PLANE = 'plane';
}
