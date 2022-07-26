<?php

namespace App\Contract;

/**
 * Quote Provider Interface
 */
interface QuoteProvider
{
    /**
     * @return mixed
     */
    public function quote(): mixed;
}
