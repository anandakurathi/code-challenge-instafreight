<?php
namespace App\Controller;

use App\Contract\CurlProvider;
use App\Contract\QuoteProvider;

class Quote
{

    /**
     * @param  QuoteProvider  $provider
     * @return mixed
     */
    public function quote(QuoteProvider $provider): mixed
    {
        return $provider->quote();
    }
}
