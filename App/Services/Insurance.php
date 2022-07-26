<?php

namespace App\Services;

use App\Contract\CurlProvider;
use App\Contract\QuoteProvider;

class Insurance implements QuoteProvider
{

    const INSURANCE_URL = 'http://demo9084693.mockable.io/insurance';

    /**
     * Request quote from Insurance company
     * @return string
     */
    public function quote(): string
    {
        $curl = new curl();
        $curl->url(self::INSURANCE_URL)
            ->method('POST')
            ->data([
                'month' => 3,
            ])
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
