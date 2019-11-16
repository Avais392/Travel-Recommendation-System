<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/6/2018
 * Time: 11:32 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function pageLoad()
    {
        session_start();

        $isUserLoggedIn = false;
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $isUserLoggedIn = true;
        }

        return view( "Login", [ 'isUserLoggedIn' => $isUserLoggedIn ] );
    }

    public function loginSubmit( Request $req )
    {
        $this->validate( $req, [

            'type_of_user' => 'in:Simple,Business',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ] );

        $user = User::where( [

            ['email', '=', $req[ 'email' ]],
            [ 'type', '=', $req[ 'type_of_user' ] ]

        ])->first();


        if ( !isset( $user ) )
        {
            return redirect()->back()->withErrors( [ 'loginError'  => "User Not Found!" ] )->withInput();
        }

        if ( password_verify( $req[ "password" ], $user->password ) )
        {
            //session_start();
            session_start();

            $_SESSION[ 'userID' ] = $user->id;
            $_SESSION[ 'type' ] = $user->type;

            if ( $user->type == "Simple" )
            {
                return redirect()->route( 'SimpleUserController_pageLoad' );
            }
            else
            {
                return redirect()->route( 'BusinessUserController_pageLoad' );
            }
        }
        else
        {
            return redirect()->back()->withErrors( [ 'loginError'  => "Wrong Password" ] )->withInput();
        }
    }
}