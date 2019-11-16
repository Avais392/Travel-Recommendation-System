<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Socialite;
use App\User;


class SocialAuthFacebookController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(  )
    {
        $userDetails = Socialite::driver('facebook')->user();

        $userInDB = User::where( 'email', '=', $userDetails->email )->get();

        if ( count($userInDB) > 0 )
        {
            echo "User exists";

            session_start();

            $_SESSION[ 'userID' ] = $userInDB[0]->id;
            $_SESSION[ 'type' ] = $userInDB[0]->type;

            if ( $userInDB[0]->type == "Simple" )
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

            $newUser = new User();

            $newUser->username = $userDetails->id;
            $newUser->email = $userDetails->email;
            $newUser->name = $userDetails->name;
            $newUser->image = $userDetails->avatar;
            $newUser->gender = "Male";
            $newUser->type = "Simple";
            $newUser->dob = "1996-12-3";
            $newUser->password = password_hash( "itShouldBeRandom"  , PASSWORD_DEFAULT ) ;

            $newUser->save();

            session_start();

            $lastUser = User::orderBy( 'created_at', 'desc' )->first();

            $_SESSION[ 'userID' ] = $lastUser->id;
            $_SESSION[ 'type' ] = $lastUser->type;

            if ( $lastUser->type == "Simple" )
            {
                return redirect()->route( 'SimpleUserController_pageLoad' );
            }
            else
            {
                return redirect()->route( 'BusinessUserController_pageLoad' );
            }
        }
    }
}
