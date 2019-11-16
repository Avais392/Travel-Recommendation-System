<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/3/2018
 * Time: 11:34 PM
 */

namespace App\Http\Controllers;
use App\Destination;


class DestinationController extends Controller
{
    public function pageLoad( $id )
    {
        session_start();

        $isUserLoggedIn = false;
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $isUserLoggedIn = true;
        }
        $destination = Destination::where( 'id', '=', $id )->first();
        return view( "Destination", [ 'destination' => $destination, 'isUserLoggedIn' => $isUserLoggedIn ] );
    }
}