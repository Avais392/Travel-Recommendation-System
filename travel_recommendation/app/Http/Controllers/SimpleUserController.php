<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/5/2018
 * Time: 10:21 PM
 */

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\User;
use App\Compress;
use App\HotelOrRestaurant;
use Illuminate\Support\Facades\DB;
use App\HotelOrRestaurantFeature;


class SimpleUserController extends Controller
{
    public function pageLoad( $id = null )
    {
        $isUserLoggedIn = false;
        if ( $id != null )
        {
            $userID = $id;
            //check for session
            session_start();

            if ( isset( $_SESSION[ 'userID' ] ) )
            {
                $isUserLoggedIn = true;
                if ( $_SESSION[ 'userID' ] == $id )
                {
                    $isAlreadyLoggedInUser = true;
                }
                else
                {
                    $isAlreadyLoggedInUser = false;
                }
            }
            else
            {
                $isAlreadyLoggedInUser = false;
            }
        }
        else
        {
            session_start();
            if ( isset( $_SESSION[ 'userID' ] ) )
            {
                $isAlreadyLoggedInUser = true;
                $isUserLoggedIn = true;
                $userID = $_SESSION[ 'userID' ];
            }
            else
            {
                return redirect()->route( 'LoginController_pageLoad' ) -> with( [ 'message' => 'Please login first!' ] );
            }
        }

        $loggedInUSer = User::where( 'id', '=', $userID )->first();

        return view("SimpleUser", [ 'user' => $loggedInUSer, 'isUserLoggedIn' => $isUserLoggedIn, 'isAlreadyLoggedInUser' => $isAlreadyLoggedInUser ]);
    }


    public function addNewHotel(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'destination' => 'required',
            'attraction' => '',
            'hotelPic' => 'file|image|max:5120',
            'website' => 'url',
            'email' => 'email',
            'fax' => '',
            'phoneNum' => '',
            'description' => '',
            'rentPerDay' => 'required|numeric'
        ]);


        $hotel = new HotelOrRestaurant();

        $hotel->type = "Hotel";
        $hotel->name = $request[ "name" ];
        $hotel->destinationID = $request[ "destination" ];
        $hotel->attractionID = $request[ "attraction" ];
        $hotel->description = $request[ "description" ];
        $hotel->phone = $request[ "phoneNum" ];
        $hotel->fax = $request[ "fax" ];
        $hotel->email = $request[ "email" ];
        $hotel->website = $request[ "website" ];
        $hotel->rating = 0;

        session_start();

        $hotel->createdBy = $_SESSION[ 'userID' ];
        $hotel->rentPerDay = $request[ "rentPerDay" ];
        $hotel->pic = "hotel_images/hotel.jpg";

        DB::beginTransaction();

        try {
            $hotel->save();
            $lastHotelID = HotelOrRestaurant::orderBy( 'created_at', 'desc' )->first()->id;
        }
        catch ( QueryException $e )
        {
            DB::rollback();
            return redirect()->back()->withErrors( ["1" => $e->getMessage()] )->withInput();
        }


        if ( $request->hasFile( 'hotelPic' ) )
        {
            $extension = $request->file( 'hotelPic' )->getClientOriginalExtension();
            $filename = "hotel_pic_$lastHotelID.$extension";

            $request->file( 'hotelPic' )->move("hotel_images", $filename);
            $hotelPic = "hotel_images/$filename";
            try
            {
                HotelOrRestaurant::where( 'id', '=', $lastHotelID )->update( [
                    "pic" => $hotelPic
                ] );
            }
            catch ( QueryException $e )
            {
                DB::rollback();
                return redirect()->back()->withErrors( ["1" => "Display pic changing failed!"] )->withInput();
            }
        }




        //Features
        for ( $i = 1; $i <= 2; $i++ )
        {
            if ( isset( $request[ "featureID_$i" ] ) )
            {

                $feature = new HotelOrRestaurantFeature();

                $feature->hotelOrRestaurantID = $lastHotelID;
                $feature->featureID = $request[ "featureID_$i" ];

                try
                {
                    $feature->save();
                }
                catch ( QueryException $e )
                {
                    DB::rollback();
                    return redirect()->back()->withErrors( ["1" => "Features error"] )->withInput();
                }
            }

        }

        DB::commit();


        return redirect()->back()->with([ 'successMessage' => 'Hotel created successful!' ]);


        //$file = 'koala.jpg'; //file that you wanna compress
        //$new_name_image = 'koala_mini'; //name of new file compressed
        /*
         * Quality: 0 - 100
         * 0: Worst quality
         * 100: Beautiful, but still the same size as the original image or bigger
         */
        //$quality = 60; // Value that I chose
        //$destination = 'content'; //This destination must be exist on your project
        //$image_compress = new Compress($file, $new_name_image, $quality, $destination);
        //echo $image_compress->compress_image();

    }

    public function addNewRestaurant(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'destination' => 'required',
            'attraction' => '',
            'pic' => 'file|image|max:5120',
            'website' => 'url',
            'email' => 'email',
            'fax' => '',
            'phoneNum' => '',
            'description' => ''
        ]);


        $hotel = new HotelOrRestaurant();

        $hotel->type = "Restaurant";
        $hotel->name = $request[ "name" ];
        $hotel->destinationID = $request[ "destination" ];
        $hotel->attractionID = $request[ "attraction" ];
        $hotel->description = $request[ "description" ];
        $hotel->phone = $request[ "phoneNum" ];
        $hotel->fax = $request[ "fax" ];
        $hotel->email = $request[ "email" ];
        $hotel->website = $request[ "website" ];
        $hotel->rating = 0;

        session_start();

        $hotel->createdBy = $_SESSION[ 'userID' ];
        $hotel->pic = "restaurant_images/restaurant.jpg";

        DB::beginTransaction();

        try {
            $hotel->save();
            $lastID = HotelOrRestaurant::orderBy( 'created_at', 'desc' )->first()->id;
        }
        catch ( QueryException $e )
        {
            DB::rollback();
            return redirect()->back()->withErrors( ["1" => $e->getMessage()] )->withInput();
        }


        if ( $request->hasFile( 'pic' ) )
        {
            $extension = $request->file( 'pic' )->getClientOriginalExtension();
            $filename = "restaurant_pic_$lastID.$extension";

            $request->file( 'pic' )->move("restaurant_images", $filename);
            $hotelPic = "restaurant_images/$filename";
            try
            {
                HotelOrRestaurant::where( 'id', '=', $lastID )->update( [
                    "pic" => $hotelPic
                ] );
            }
            catch ( QueryException $e )
            {
                DB::rollback();
                return redirect()->back()->withErrors( ["1" => "Display pic changing failed!"] )->withInput();
            }
        }




        //Features
        for ( $i = 1; $i <= 2; $i++ )
        {
            if ( isset( $request[ "featureID_$i" ] ) )
            {

                $feature = new HotelOrRestaurantFeature();

                $feature->hotelOrRestaurantID = $lastID;
                $feature->featureID = $request[ "featureID_$i" ];

                try
                {
                    $feature->save();
                }
                catch ( QueryException $e )
                {
                    DB::rollback();
                    return redirect()->back()->withErrors( ["1" => "Features error"] )->withInput();
                }
            }

        }

        DB::commit();


        return redirect()->back()->with([ 'successMessage' => 'Restaurant Created successful!' ]);


        //$file = 'koala.jpg'; //file that you wanna compress
        //$new_name_image = 'koala_mini'; //name of new file compressed
        /*
         * Quality: 0 - 100
         * 0: Worst quality
         * 100: Beautiful, but still the same size as the original image or bigger
         */
        //$quality = 60; // Value that I chose
        //$destination = 'content'; //This destination must be exist on your project
        //$image_compress = new Compress($file, $new_name_image, $quality, $destination);
        //echo $image_compress->compress_image();

    }

    public function changeProfilePic( Request $req )
    {
        $this->validate($req, [
            'profilePic' => 'Required|file|image|max:5120'
        ]);


        $extension = $req->file( 'profilePic' )->getClientOriginalExtension();
        $filename = "user_1.$extension";
        $directory = "user_images";

        $req->file( 'profilePic' )->move($directory, $filename);
        $profilePic = "$directory/$filename";


        session_start();

        User::where( [
            [ 'id', '=', $_SESSION[ 'userID' ] ]
        ] )
            ->update( [
                "image" => $profilePic
            ] );

        return redirect()->back()->with( [ 'successMessage' => 'Profile pic is updated successfully!' ] );

    }
}