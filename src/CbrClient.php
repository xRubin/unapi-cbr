<?php
namespace unapi\cbr;

use GuzzleHttp\Client;

class CbrClient extends Client
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config['base_uri'] = 'http://www.cbr.ru';
        $config['cookies'] = true;

        parent::__construct($config);
    }
}