<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Support\Fuzziness;

trait HasFuzziness
{
    /**
     * @var Fuzziness|null
     */
    private $fuzziness;

    /**
     * @param Fuzziness $fuzziness
     * @return self
     */
    public function setFuzziness(Fuzziness $fuzziness): self
    {
        $this->fuzziness = $fuzziness;
        return $this;
    }
}
