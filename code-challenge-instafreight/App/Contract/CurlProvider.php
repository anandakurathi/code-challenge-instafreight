<?php

namespace App\Contract;

/**
 * Curl Provider interface
 */
interface CurlProvider
{

    /**
     * function to set data inputs to send
     * @param  string  $url
     */
    public function url(string $url = '');

    /**
     * function to set data inputs to send
     * @param  array  $data
     */
    public function data(array $data = []);

    /**
     * function to set request method (defaults to get)
     * @param  string  $method
     */
    public function method(string $method = 'get');

    /**
     * function that will send our request
     */
    public function send();

    /**
     * function that will close the connection of the curl handler
     */
    public function close();

}
