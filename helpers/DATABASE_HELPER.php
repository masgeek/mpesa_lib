<?php
/**
 * Created by PhpStorm.
 * User: masgeek
 * Date: 21-Feb-18
 * Time: 14:39
 */

namespace helper;

use Medoo\Medoo;

$root_dir = dirname(dirname(__FILE__));


require_once $root_dir . '/vendor/autoload.php';

class DATABASE_HELPER
{
    public $database;

    public function __construct()
    {

        $this->database = new Medoo([
            'database_type' => 'sqlite',
            'database_file' => '../db/mpesa.db'

        ]);

    }

    public function WriteSTKToDatabase(array $arrayData)
    {
        $result = 0;

        $data = (object)$arrayData;

        $checkoutRequestID = $data->checkoutRequestID; //let us use this to check the records


        $result = $this->CheckTransaction($checkoutRequestID);  //$this->InsertTotable($arrayData);

        if ($result == null) {
            //proceed with insertion
            $result = $this->InsertTotable($arrayData);
        } else {
            unset($arrayData['checkoutRequestID']); //remove teyh uniqe key
            //proceed with updates
            $result = $this->UpdateTotable($checkoutRequestID, $arrayData);
        }
        //var_dump($data);
        return $result;
    }

    protected function CheckTransaction($checkoutID)
    {
        $data = $this->database->select('mpesa', '*', ['checkoutRequestID' => $checkoutID]);

        return count($data) > 0 ? $data[0] : null;

    }

    protected function UpdateTotable($checkoutID, array $arrayData)
    {
        $this->database->update("mpesa", $arrayData, [
            'checkoutRequestID' => $checkoutID
        ]);

        return $this->database->last();
    }

    protected function InsertTotable(array $arrayData)
    {
        $this->database->insert("mpesa", $arrayData);

        return $this->database->id();
    }
}