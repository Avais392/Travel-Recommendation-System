<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/6/2018
 * Time: 11:14 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SignUpController extends Controller
{
    public function pageLoad()
    {
        session_start();
        $isUserLoggedIn = false;
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $isUserLoggedIn = true;
        }
        return view( "SignUp", [ 'isUserLoggedIn' => $isUserLoggedIn ] ) ;
    }

    public function SignUpSubmit( Request $req )
    {
        $this->validate( $req, [

            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'dob' => 'required|date',
            'type_of_user' => 'in:Simple,Business',
            'email' => 'required|email',
            'gender' => 'required|in:Male,Female',
            'password' => 'required|min:5',
            'password_again' => 'required|min:5|same:password',
            'username' => 'required|unique:users,username'

        ] );


        $newUser = new User();

        $newUser->username = $req[ "username" ];
        $newUser->password = password_hash( $req[ "password" ] , PASSWORD_DEFAULT ) ;
        $newUser->email = $req[ "email" ] ;
        $newUser->dob = $req[ "dob" ] ;
        $newUser->name = $req[ "first_name" ] . " " . $req[ "last_name" ];
        $newUser->gender = $req[ "gender" ];
        $newUser->type = $req[ "type_of_user" ];

        if ( $newUser->gender == "Male" )
        {
            $newUser->image = "user_images/dummyMaleImage.png";
        }
        else
        {
            $newUser->image = "user_images/dummyFemaleImage.png";
        }

        $newUser->save();

        return redirect()->route('LoginController_pageLoad')->with([ 'signUpComplete' => 'yes' ]);
    }
}