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
        //var_dump($this->APPLICATION_STATUS);
        //var_dump($this->BASE_URL);
    }


    /**
     * Get access token used to authorize mpesa transactions
     * @param string $endpoint
     * @return array|object|string
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function GenerateToken($endpoint = '/oauth/v1/generate?grant_type=client_credentials')
    {
        return  'dlQFvOnyfgIXlYKsInvvlQxCwCjz';
        $uri = "{$this->BASE_URL}{$endpoint}";

        $credentials = base64_encode("{$this->APP_CONSUMER_KEY}:{$this->APP_CONSUMER_SECRET}");


        $headers = ['Authorization' => 'Basic ' . $credentials];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->BASE_URL,
            // You can set any number of default request options.
            'timeout' => 2.0,
            //'verify' => false
        ]);

        $response = $client->request('GET', $endpoint, [
            'headers' => $headers
        ]);
        /*
    $response = Request::get($uri)
        ->addHeaders(array(
            'Authorization' => 'Basic ' . $credentials,
        ))
        //->strictSSL(false)
        ->withoutStrictSSL()
        ->send();

    return $response->body->access_token;*/

        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        $bodyContent = $response->getBody()->getContents();
        $content = json_decode($bodyContent);

        return $content->access_token;
    }

    protected function GenerateTokenOld($endpoint = '/oauth/v1/generate?grant_type=client_credentials')
    {
        $uri = "{$this->BASE_URL}{$endpoint}";

        $credentials = base64_encode("{$this->APP_CONSUMER_KEY}:{$this->APP_CONSUMER_SECRET}");

        $response = Request::get($uri)
            ->addHeaders(array(
                'Authorization' => 'Basic ' . $credentials,
            ))
            //->strictSSL(false)
            ->withoutStrictSSL()
            ->send();

        return $response->body->access_token;
    }

    /**
     * Gives you time bound access token to call allowed APIs
     * @param string $endpoint
     * @throws \Exception
     */
    public function OAuth($endpoint = '/oauth/v1/generate')
    {
        throw new \Exception('Not implemented', '500');
    }


    /**
     * Use this API for reversal transaction
     * @param string $endpoint
     * @throws \Exception
     */
    public function Reversal($endpoint = '/mpesa/reversal/v1/request')
    {
        throw new \Exception("Not Implemented", 500);
    }

    /**
     * Mpesa Transaction from company to client
     * @param string $endpoint
     */
    public function BusinessToConsumer($endpoint = '/mpesa/b2c/v1/paymentrequest')
    {
    }

    /**
     * Use this API for balance inquiry
     * @param string $endpoint
     */
    public function AccountBalance($endpoint = '/mpesa/accountbalance/v1/query')
    {
    }

    /**
     * Use this API to check the status of transaction
     * @param string $endpoint
     */
    public function TransactionStatus($endpoint = '/mpesa/transactionstatus/v1/query')
    {
    }

    /**
     * Mpesa Transaction from one company to another
     * @param string $endpoint
     */
    public function BusinessToBusiness($endpoint = '/mpesa/b2b/v1/paymentrequest')
    {
    }

    /**
     * For Lipa Na M-Pesa online payment using STK Push.
     * @param $body
     * @param string $endpoint
     * @return mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function LipaNaMpesaRequest($body, $endpoint = '/mpesa/stkpushquery/v1/query')
    {
        $uri = "{$this->BASE_URL}{$endpoint}";

        return $this->ProcessRequest($body, $uri);
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
        $uri = "{$this->BASE_URL}{$endpoint}";

        return $this->ProcessRequest($body, $uri);
    }

    /**
     * Register URL for Validation/Confirmation and Simulate transaction
     * @param string $endpoint
     */
    public function ConsumerToBusinessRegister($endpoint = '/mpesa/c2b/v1/registerurl')
    {
    }


    /**
     * Register URL for Validation/Confirmation and Simulate transaction
     * @param $body
     * @param string $endpoint
     * @return mixed
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function ConsumerToBusinessSimulate($body, $endpoint = '/mpesa/c2b/v1/simulate')
    {
        $uri = "{$this->BASE_URL}{$endpoint}";


        return $this->ProcessRequest($body, $uri);
    }


    public function CommandIds($commandId)
    {
        /*
         * TransactionReversal	Reversal for an erroneous C2B transaction.
SalaryPayment	Used to send money from an employer to employees e.g. salaries
BusinessPayment	Used to send money from business to customer e.g. refunds
PromotionPayment	Used to send money when promotions take place e.g. raffle winners
AccountBalance	Used to check the balance in a paybill/buy goods account (includes utility, MMF, Merchant, Charges paid account).
CustomerPayBillOnline	Used to simulate a transaction taking place in the case of C2B Simulate Transaction or to initiate a transaction on behalf of the customer (STK Push).
TransactionStatusQuery	Used to query the details of a transaction.
CheckIdentity	Similar to STK push, uses M-Pesa PIN as a service.
BusinessPayBill	Sending funds from one paybill to another paybill
BusinessBuyGoods	sending funds from buy goods to another buy goods.
DisburseFundsToBusiness	Transfer of funds from utility to MMF account.
BusinessToBusinessTransfer	Transferring funds from one paybills MMF to another paybills MMF account.
BusinessTransferFromMMFToUtility	Transferring funds from paybills MMF to another paybills utility account.
         */

        return "Under Development";
    }

    public function IdentifierTypes()
    {
        $identifier = [1 => 'MSISDN',
            2 => 'Till Number',
            4 => 'Shortcode'];

        return $identifier;
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
        $payload = json_encode($body); //convert array to json
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization:Bearer {$token}")); //setting custom header


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HEADER, false);


        $curl_response = curl_exec($curl);

        return $curl_response;
    }
}