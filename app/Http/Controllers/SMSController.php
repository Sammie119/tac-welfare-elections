<?php

namespace App\Http\Controllers;

use App\Zenoph\Notify\Enums\AuthModel;
use App\Zenoph\Notify\Request\CreditBalanceRequest;
use App\Zenoph\Notify\Request\RequestException;
use App\Zenoph\Notify\Request\SMSRequest;
use Exception;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    static function sendSMS($phone, $msg)
    {
        try {
            // Initialise SMS request
            $request = new SMSRequest();

            // set request host and authentication properties
            $request->setHost(env('SMS_HOST'));
            $request->setAuthModel(AuthModel::API_KEY);
            $request->setAuthApiKey(env('SMS_API_KEY'));

            // set message properties and submit
            $request->setMessage($msg);
            $request->setSender(env('SMS_SENDER_ID'));
            $request->addDestination($phone);
            $request->submit();
        }

        catch (RequestException $ex){
            // get the handshake indicator to know the cause of the error
            $handshake = $ex->getRequestHandshake();

            // Exception catch code continues
        }
    }

    public function checkSMSBalance()
    {
        try {
            // create request object
            $request = new CreditBalanceRequest();
            $request->setHost(env('SMS_HOST'));
            $request->useSecureConnection(false);
            $request->setAuthModel(AuthModel::API_KEY);
            $request->setAuthApiKey(env('SMS_API_KEY'));

            // get the balance
            $response = $request->submit();

            // output the balance
            $balance = $response->getBalance();

            echo "Your balance is: {$balance}.";
        }

        catch (Exception $ex) {
            die (printf("Error: %s.", $ex->getMessage()));
        }

    }
}
