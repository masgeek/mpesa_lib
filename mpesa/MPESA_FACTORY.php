<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 29-Aug-17
 * Time: 10:15
 */

namespace mpesa;

$root_dir = dirname(dirname(__FILE__));

use Httpful\Request;
use Medoo\Medoo;

require_once $root_dir . '/vendor/autoload.php';

class MPESA_FACTORY
{
    /**
     * Base url for the API endpoints
     * @var string
     */
    public $BASE_URL = 'https://sandbox.safaricom.co.ke';

    public $access_token;
    protected $APP_CONSUMER_KEY;
    protected $APP_CONSUMER_SECRET;
    protected $database;

    /**
     * MPESA_FACTORY constructor.
     * @param null $consumer_key
     * @param null $consumer_secret
     * @throws \Exception
     */
    function __construct($consumer_key, $consumer_secret)
    {
        //set the consumer keys
        $this->APP_CONSUMER_KEY = $consumer_key;
        $this->APP_CONSUMER_SECRET = $consumer_secret;
    }


    /**
     * Get access token used to authorize mpesa transactions
     * @param string $endpoint
     * @return array|object|string
     */
    public function GetAccessToken($endpoint = '/oauth/v1/generate?grant_type=client_credentials')
    {
        $uri = "{$this->BASE_URL}{$endpoint}";

        $credentials = base64_encode("{$this->APP_CONSUMER_KEY}:{$this->APP_CONSUMER_SECRET}");

        $response = Request::get($uri)
            ->addHeaders(array(
                'Authorization' => 'Basic ' . $credentials,
            ))
            ->strictSSL(false)
            ->send();

        return $response->body->access_token;
    }

    /**
     * Gives you time bound access token to call allowed APIs
     * @param string $endpoint
     */
    public function OAuth($endpoint = '/oauth/v1/generate')
    {
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
     * @param string $endpoint
     */
    public function LipaNaMpesaRequest($endpoint = '/mpesa/stkpushquery/v1/query')
    {
    }

    /**
     * For Lipa Na M-Pesa online payment using STK Push.
     * @param string $endpoint
     */
    public function LipaNaMpesaProcessRequest(array $body, $endpoint = '/mpesa/stkpush/v1/processrequest')
    {
        $uri = "{$this->BASE_URL}{$endpoint}";

        $payload = json_encode($body); //convert array to json

        /*
        $response = Request::post($uri)// Build a PUT request...
        ->sendsJson()
        ->authenticateWith('username', 'password')
        ->addHeaders(array(
            'Authorization' => 'Bearer ' . $this->access_token,
        ))
            ->body($payload)
            ->send();

        return $response;*/
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer 63Ns4zyD8JHr1UOHDclnHUyH80j4")); //setting custom header



        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

        $curl_response = curl_exec($curl);

        return  $curl_response;
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
     * @param string $endpoint
     */
    public function ConsumerToBusinessSimulate($endpoint = '/mpesa/c2b/v1/simulate')
    {
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
}