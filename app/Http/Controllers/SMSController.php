<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users_Details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserAccountsController extends Controller
{

    public function SMS($mobile, $msg)
    {
        // try {
                    
            // SEMAPHORE
            $ch = curl_init();
            $greeting = [];
            $morning = "Madiyaw nga Hinaat";
            $noon = "Madiyaw nga Udto";
            $afternoon = "Madiyaw nga Hapon";
            $evening = "Madiyaw nga Doom";

            $time = date("H");
            /* Set the $timezone variable to become the current timezone */
            $timezone = date("Asia/Manila");
            /* If the time is less than 1200 hours, show good morning */
            if ($time < "12") {
                array_push($greeting, $morning);
            } else
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                array_push($greeting, $noon);
            } else
            /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
            if ($time >= "17" && $time < "19") {
                array_push($greeting, $afternoon);
            } else
            /* Finally, show good night if the time is greater than or equal to 1900 hours */
            if ($time >= "19") {
                array_push($greeting, $evening);
            }

            $concat_msg = $greeting[0]. '! ' . $msg;
            $semaphore_apicode = "31c97d12e6675e28b4cef6f2dca15546";

            $parameters = array(
                'apikey' => $semaphore_apicode, //Your API KEY
                'number' => $mobile,
                'message' => $concat_msg,
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
        // } catch (\Exception $e) {
        //     return [
        //         'status' => 0,
        //         'message' => $e->getMessage(),
        //     ];
        // }
    }

}
