<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 29-Aug-17
 * Time: 10:15
 */

namespace mpesa;

$root_dir = dirname(dirname(__FILE__));

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Httpful\Request;

require_once $root_dir . '/vendor/autoload.php';

class MPESA_FACTORY
{
    /**
     * Base url for the API endpoints
     * @var string
     */
    protected $BASE_URL;

    //public $access_token;
    protected $APP_CONSUMER_KEY;
    protected $APP_CONSUMER_SECRET;
    protected $APPLICATION_STATUS;
    protected $client;
    protected $database;

    /**
     * MPESA_FACTORY constructor.
     */
    function __construct()
    {
        //read the environment variables
        $dotenv = new Dotenv(dirname(__DIR__));
        //$dotenv->required(['consumer_key', 'consumer_secret', 'application_status']);
        $dotenv->load();
        //set the consumer keys
        $this->APP_CONSUMER_KEY = getenv('consumer_key');
        $this->APP_CONSUMER_SECRET = getenv('consumer_secret');
        $this->APPLICATION_STATUS = getenv('application_status');

        if ($this->APPLICATION_STATUS == 'live') {
            $this->BASE_URL = 'https://api.safaricom.co.ke';
        } else {
            $this->BASE_URL = 'https://sandbox.safaricom.co.ke';
        }

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->BASE_URL,
            // You can set any number of default request options.
            'timeout' => 60, //timeout after 30 seconds
            //'verify' => false
        ]);
    }


    /**
     * Get access token used to authorize mpesa transactions
     * @param string $endpoint
     * @return array|object|string
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    protected function GenerateToken($endpoint = '/oauth/v1/generate?grant_type=client_credentials')
    {
        $credentials = base64_encode("{$this->APP_CONSUMER_KEY}:{$this->APP_CONSUMER_SECRET}");
        $headers = ['Authorization' => 'Basic ' . $credentials];
        $response = $this->client->request('GET', $endpoint, [
            'headers' => $headers
        ]);

        $bodyContent = $response->getBody()->getContents();
        $content = json_decode($bodyContent);

        return $content->access_token;
    }

    /**
     * For Lipa Na M-Pesa online payment using STK Push.
     * @param $body
     * @param string $endpoint
     * @return mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function LipaNaMpesaRequestQuery($body, $endpoint = '/mpesa/stkpushquery/v1/query')
    {

        return $this->ProcessRequest($body, $endpoint);
    }

    /**
     * For Lipa Na M-Pesa online payment using STK Push.
     * @param array $body
     * @param string $endpoint
     * @return mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function LipaNaMpesaProcessRequest(array $body, $endpoint = '/mpesa/stkpush/v1/processrequest')
    {

        return $this->ProcessRequest($body, $endpoint);
    }

    /**
     * @param bool $asDate
     * @return int|string
     */
    public function GetTimeStamp($asDate = false)
    {
        $date = new \DateTime();

        return $asDate ? $date->format('Ymdhis') : $date->getTimestamp();
    }

    /**
     * @param array $body
     * @param $uri
     * @return mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    protected function ProcessRequest(array $body, $uri)
    {
        $token = $this->GenerateToken();

        $response = $this->client->request('POST', $uri, [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($body)
        ]);
        $bodyContent = $response->getBody()->getContents();
        $content = json_decode($bodyContent);

        return $content;
    }
}