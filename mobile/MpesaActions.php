<?php


namespace mpesa;

$root_dir = dirname(dirname(__FILE__));

use Dotenv\Dotenv;
use Safaricom\Mpesa\Mpesa;

require_once $root_dir . '/vendor/autoload.php';

class MpesaActions
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
    }

    /**
     * @param $ShortCode
     * @param $CommandID
     * @param $Amount
     * @param $Msisdn
     * @param $BillRefNumber
     * @return mixed|string
     */
    public function processMe($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber)
    {
        $dat = Mpesa::c2b($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber);

        return $dat;
    }
}