<?php

namespace App\Services;

use App\Contract\QuoteProvider;

class Bank implements QuoteProvider
{

    const BANK_URL = 'http://demo9084693.mockable.io/bank';

    /**
     * Request quote from Bank
     * @return string
     */
    public function quote(): string
    {
        $curl = new curl();
        $curl->url(self::BANK_URL)
            ->method('GET')
            ->send();

        if ($curl->error) {
            return 'Curl error: '.$curl->error;
        }

        if ($curl->info['http_status_code'] !== 200) {
            return 'Specified URL does not exist or not connectable';
        }

        $curl->close();

        return $curl->content;
    }
}
