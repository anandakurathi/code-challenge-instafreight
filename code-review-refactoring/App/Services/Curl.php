<?php

namespace App\Services;

use App\Contract\CurlProvider;

/**
 * CURL Request maker Class
 */
class Curl implements CurlProvider
{

    /**
     * class variable that will hold the curl request handler
     * @var string
     */
    public string $content = '';
    /**
     * class variable that will hold the data inputs of our request
     * @var array
     */
    public array $info = [];
    /**
     * class variable that will hold the error data of our request
     * @var array
     */
    public ?string $error = null;
    /**
     * class variable that will hold the url
     * @var null
     */
    private $handler = null;
    /**
     * class variable that will hold the info of our request
     * @var string
     */
    private string $url = '';
    /**
     * class variable that will tell us what type of request method to use (defaults to get)
     * @var array
     */
    private array $data = [];
    /**
     * class variable that will hold the response of the request in string
     * @var string
     */
    private string $method = 'get';

    /**
     * function to set data inputs to send
     * @param  string  $url
     * @return $this
     */

    public function url(string $url = ''): static
    {
        $this->url = $url;
        return $this;
    }

    /**
     * function to set data inputs to send
     * @param  array  $data
     * @return $this
     */
    public function data(array $data = []): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * function to set request method (defaults to get)
     * @param  string  $method
     * @return $this
     */
    public function method(string $method = 'get'): static
    {
        $this->method = $method;
        return $this;
    }

    /**
     * function that will send our request
     */
    public function send()
    {
        try {
            if ($this->handler == null) {
                $this->handler = curl_init();
            }

            switch (strtolower($this->method)) {
                case 'post':
                    curl_setopt_array($this->handler, [
                        CURLOPT_URL            => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => count($this->data),
                        CURLOPT_POSTFIELDS     => http_build_query($this->data),
                    ]);
                    break;
                case 'put':
                    curl_setopt_array($this->handler, [
                        CURLOPT_URL            => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST  => 'PUT',
                        CURLOPT_POSTFIELDS     => http_build_query($this->data),
                    ]);
                    break;
                case 'delete':
                    curl_setopt_array($this->handler, [
                        CURLOPT_URL            => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST  => 'DELETE',
                        CURLOPT_POSTFIELDS     => http_build_query($this->data),
                    ]);
                    break;

                default:
                    curl_setopt_array($this->handler, [
                        CURLOPT_URL            => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                    ]);
                    break;
            }

            $this->content = curl_exec($this->handler);

            $this->info = curl_getinfo($this->handler);

            if ($this->content === false) {
                $this->error = curl_error($this->handler);
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * function that will close the connection of the curl handler
     */
    public function close()
    {
        curl_close($this->handler);
        $this->handler = null;
    }

}

