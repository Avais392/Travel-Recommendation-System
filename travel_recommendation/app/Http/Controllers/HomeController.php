<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/3/2018
 * Time: 3:17 AM
 */

namespace App\Http\Controllers;

use App\Feature;
use App\Destination;
use App\HotelOrRestaurant;
use App\Attraction;


use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function pageLoad()
    {
        session_start();
        $isUserLoggedIn = false;
        if ( isset( $_SESSION[ 'userID' ] ) )
        {
            $isUserLoggedIn = true;
        }
        $features = Feature::all();
        return view( 'Home', [ 'features' => $features, 'isUserLoggedIn' => $isUserLoggedIn ] );
    }

    public function processSearchString( Request $req )
    {
        $this->validate( $req, [

            'searchString' => 'required',
            'priceUpperBound' => 'required|numeric',
            'priceLowerBound' => 'required|numeric',
            'ratingUpperBound' => 'required|numeric',
            'ratingLowerBound' => 'required|numeric'

        ] );

        $featuresString = $req[ "features" ];

        if ( $featuresString == ""  )
        {
            $givenFeatures = [];
        }
        else
        {
            $givenFeatures = explode( ',', $featuresString );
            array_pop( $givenFeatures );
        }

        $destinations = Destination::all();
        $hotels = HotelOrRestaurant::where( [

            [ 'rating', '>=', $req[ 'ratingLowerBound' ] ],
            [ 'rating', '<=', $req[ 'ratingUpperBound' ] ],
            [ 'rentPerDay', '>=', $req[ 'priceLowerBound' ] ],
            [ 'rentPerDay', '<=', $req[ 'priceUpperBound' ] ]

        ] )->get();

        $filteredHotels = [];

        foreach ( $hotels as $hotel )
        {
            $hotelFeatureIDs = [];

            foreach ( $hotel->features as $f )
            {
                $hotelFeatureIDs[] = $f->featureID;
            }

            $shouldAdd = true;
            foreach ( $givenFeatures as $fea )
            {
                if ( !in_array( $fea, $hotelFeatureIDs ) )
                {
                    $shouldAdd = false;
                    break;
                }
            }
            if ( $shouldAdd == true )
            {
                $filteredHotels[] = $hotel;
            }
        }

        $hotels = $filteredHotels;
        $attractions = Attraction::all();

        /*
        $destinations = [

            [ "name" => 'Kaula Lampur' ],
            [ "name" => 'Punta Cana' ],
            [ "name" => 'Istanbul' ],
            [ "name" => 'Paris' ],
            [ "name" => 'Venice']

        ];

        $hotels = [

            [ 'name' => 'Hitlon Kaula Lampur', 'destination' => 'Kaula Lampur', "rating" => 3 ],
            [ 'name' => 'InterContinental Kaula Lampur', 'destination' => 'Kaula Lampur', "rating" => 3 ],
            [ 'name' => 'Swiss Kaula Lampur', 'destination' => 'Kaula Lampur', "rating" => 3 ],

            [ 'name' => 'Be Live Collection Punta Cana', 'destination' => 'Punta Cana', "rating" => 3 ],
            [ 'name' => 'TRS Turquesa Hotel', 'destination' => 'Punta Cana', "rating" => 3 ],
            [ 'name' => 'The Westin Punta Cana Resort', 'destination' => 'Punta Cana', "rating" => 3 ],

            [ 'name' => 'Ramada Istanbul Old City', 'destination' => 'Istanbul', "rating" => 3 ],
            [ 'name' => 'Daphne Hotel', 'destination' => 'Istanbul', "rating" => 3 ],
            [ 'name' => 'Ferman Hotel', 'destination' => 'Istalbul', "rating" => 3 ],

            [ 'name' => 'Le Relais Madeleine', 'destination' => 'Paris', "rating" => 3 ],
            [ 'name' => 'Bel Ami Hotel', 'destination' => 'Paris', "rating" => 3 ],
            [ 'name' => 'Hotel Palais de Chaillot', 'destination' => 'Paris', "rating" => 3 ],

            [ 'name' => 'Carnival Palace Hotel', 'destination' => 'Venice', "rating" => 3 ],
            [ 'name' => 'Ruzzini Palace Hotel', 'destination' => 'Venice',"rating" => 3 ],
            [ 'name' => 'Palazzo Salvadego', 'destination' => 'Venice', "rating" => 3 ]

        ];
       */



        $searchString = strtolower($req[ "searchString" ]);

        $result = [];

        foreach ( $destinations as $destination )
        {
            $nameOfDestination = strtolower($destination->name);

            $indexOfSubstring = strpos( $nameOfDestination , $searchString );

            if ( $indexOfSubstring !== false )
            {
                $dest = [];

                $dest[ "id" ] = $destination->id;
                $dest[ "type" ] = 'Destination';
                $dest[ "name" ] = ucwords(str_replace( $searchString, "<b><u>" . $searchString . "</u></b>", $nameOfDestination ) );
                $dest[ "rating" ] = round($destination->rating);
                $result[] = $dest;
            }
        }

        foreach ( $hotels as $hotel )
        {
            $name = strtolower($hotel->name);

            $indexOfSubstring = strpos( $name , $searchString );

            if ( $indexOfSubstring !== false )
            {
                $h = [];

                $h[ "id" ] = $hotel->id;
                $h[ "type" ] = $hotel->type;
                $h[ "name" ] = ucwords(str_replace( $searchString, "<b><u>" . $searchString . "</u></b>", $name ));
                $h[ "rating" ] = round($hotel->rating);
                $h[ "destination" ] = $hotel->destination->name;

                $result[] = $h;
            }
        }


        /*
        foreach ( $attractions as $attraction )
        {
            $nameOfDestination = strtolower($attraction->name);

            $indexOfSubstring = strpos( $nameOfDestination, $searchString );

            if ( $indexOfSubstring !== false )
            {
                $attr = [];

                $attr[ "id" ] = $attraction->id;
                $attr[ "type" ] = 'Attraction';
                $attr[ "name" ] = ucwords(str_replace( $searchString, "<b><u>" . $searchString . "</u></b>", $nameOfDestination ));

                $result[] = $attr;
            }
        }

        */
        return response()->json( $result );
    }
}