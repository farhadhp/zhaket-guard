<?php

//namespace ZhaketGuard;
use GuzzleHttp\Client;

class ZhaketGuard
{

    /**
     * Dont change this
     *
     * @var string
     */
    private static $apiUrl = 'http://guard.zhaket.com/api/';

    /**
     * @param $method
     * @param array $params
     * @return \Psr\Http\Message\StreamInterface|string
     */
    public static function request($method, $params=[])
    {
        if (empty($method)) {
            return 'request method can not be empty.';
        }

        $client = new Client();
        $response = $client->request('GET', self::$apiUrl.$method, [
            'query' => $params
        ]);
        return $response->getBody();
    }

    /**
     * install license
     *
     * @param $licenseToken
     * @param $productToken
     * @return \Psr\Http\Message\StreamInterface|string
     */
    public static function install($licenseToken, $productToken)
    {
        return self::request('install-license', [
            'product_token' => $productToken,
            'token' => $licenseToken,
            'domain' => self::getHost(),
        ]);
    }

    /**
     * Validate license
     *
     * @param $licenseToken
     * @return \Psr\Http\Message\StreamInterface|string
     */
    public static function isValidLicense($licenseToken)
    {
        return self::request('validation-license', [
            'token' => $licenseToken,
            'domain' => self::getHost(),
        ]);
    }

    /**
     * get host
     *
     * @return string
     */
    public static function getHost() {
        $possibleHostSources = array('HTTP_X_FORWARDED_HOST', 'HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
        $sourceTransformations = array(
            "HTTP_X_FORWARDED_HOST" => function($value) {
                $elements = explode(',', $value);
                return trim(end($elements));
            }
        );
        $host = '';
        foreach ($possibleHostSources as $source)
        {
            if (!empty($host)) break;
            if (empty($_SERVER[$source])) continue;
            $host = $_SERVER[$source];
            if (array_key_exists($source, $sourceTransformations))
            {
                $host = $sourceTransformations[$source]($host);
            }
        }

        // Remove port number from host
        $host = preg_replace('/:\d+$/', '', $host);
        // remove www from host
        $host = str_ireplace('www.', '', $host);

        return trim($host);
    }

}