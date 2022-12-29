<?php

namespace App\Http\Controllers\API;

// include("../vendor/autoload.php");
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Twilio\Rest\Client;

class SmsAPI extends Controller
{
    public function verify_registration(Request $request){

        // {
        //     "fname": "Bryan Glenn",
        //     "lname": "Yu",
        //     "mobile_number" : "09093461726",
        //     "verification_code": "123456"
        // }
        // return $request;

        // $to = request("mobile_number");
        // $from = getenv("TWILIO_FROM");
        // //open connection

        // $ch = curl_init();

        // //set the url, number of POST vars, POST data
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        // curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages', getenv("TWILIO_SID")));
        // curl_setopt($ch, CURLOPT_POST, 3);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.request("message"));

        // // execute post
        // $result = curl_exec($ch);
        // $result = json_decode($result);

        // // close connection
        // curl_close($ch);
        // //Sending message ends here
        // return [$result];

        // SEMAPHORE
        $ch = curl_init();
        $message = "Your verification code is: ". $request->verification_code ."";
        $semaphore_apicode = "480649fdb6f3c4ef6d6b37a139c0f478";

        $parameters = array(
            'apikey' => $semaphore_apicode, //Your API KEY
            'number' => request("mobile_number"),
            'message' => $message,
            'sendername' => 'SEMAPHORE'
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        $output = json_decode($output);
        return $output;
    
    }
}
