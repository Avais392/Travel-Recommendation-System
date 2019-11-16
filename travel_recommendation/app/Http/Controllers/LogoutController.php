<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 4/25/2018
 * Time: 3:27 PM
 */

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        session_start();
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $_SESSION[ 'userID' ] = null;
            $_SESSION[ 'type' ] = null;
        }

        return redirect()->route( 'LoginController_pageLoad' )->with( ['message' => 'You have been successfully logged out!'] );
    }
}