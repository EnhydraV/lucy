<?php

namespace Lucy\Blocks;

use Carbon\Carbon;
use Lucy\Contracts\BlockInterface;
use Lucy\Traits\BlockHydratorTrait;

abstract class AbstractBlock implements BlockInterface
{
    use BlockHydratorTrait;

    protected $block;

    public function getBlockId()
    {
        return $this->block;
    }

    protected function convertMonthToNumeric($month)
    {
        return Carbon::createFromFormat('M', $month)->format('m');
    }
}
