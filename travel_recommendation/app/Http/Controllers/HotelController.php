<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/4/2018
 * Time: 10:05 PM
 */

namespace App\Http\Controllers;
use App\HotelOrRestaurant;
use Illuminate\Http\Request;
use App\HotelOrRestaurantReview;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function pageLoad( $id )
    {
        $hotelOrRestaurant = HotelOrRestaurant::where( 'id', '=', $id )->first();


        session_start();

        $isUserLoggedIn = false;
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $isUserLoggedIn = true;
        }

        //GET USER ID HERE FROM SESSIONS.

        if ( $isUserLoggedIn )
        {
            $userRating = HotelOrRestaurantReview::where( [
                [ 'hotelOrRestaurantID', '=', $id ],
                [ 'postedBy', '=', $_SESSION[ 'userID' ] ]
            ] )->get();

            $hasUserAlreadyRated = false;
            if ( count($userRating) > 0 )
            {
                $hasUserAlreadyRated = true;
            }
        }
        else
        {
            $hasUserAlreadyRated = false;
        }

        return view( "Hotel", [ 'hotelOrRest' => $hotelOrRestaurant, 'isUserLoggedIn' => true, 'hotelOrRestID' => $id, 'hasUserAlreadyRated' => $hasUserAlreadyRated, 'isUserLoggedIn' => $isUserLoggedIn ] );
    }

    public function rate( Request $req )
    {
        $this->validate( $req, [

            "review" => 'required',
            'ratingValue' => 'required|numeric|min:1|max:5',
            'hotelOrRestID' => 'required|exists:hotel_or_restaurants,id'

        ] );

        $rev = new HotelOrRestaurantReview();

        $rev->hotelOrRestaurantID = $req[ "hotelOrRestID" ];
        $rev->rating = $req[ "ratingValue" ];
        $rev->review = $req[ "review" ];
        session_start();

        $postedBy = $_SESSION[ 'userID' ];
        $rev->postedBy =  $postedBy ;  //Through session!;



        DB::beginTransaction();

        try
        {
            $rev->save();
        }
        catch ( QueryException $e )
        {
            DB::rollback();
            return redirect()->back()->withErrors( ["1" => $e->getMessage()] )->withInput();
        }

        $newRating = HotelOrRestaurantReview::where( 'hotelOrRestaurantID', '=', $rev->hotelOrRestaurantID )->avg('rating' );


        try {
            HotelOrRestaurant::where( 'id', '=', $rev->hotelOrRestaurantID )->update( [
                "rating" => $newRating
            ] );
        }
        catch ( QueryException $e )
        {
            DB::rollback();
            return redirect()->back()->withErrors( ["1" => $e->getMessage()] )->withInput();
        }

        DB::commit();

        return redirect()->back()->with( [ 'successMessage' => 'Your Review has been successfully posted.' ] );
    }

}