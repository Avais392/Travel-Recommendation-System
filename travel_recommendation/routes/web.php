<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [
    'uses' => 'HomeController@pageLoad',
    'as' => 'root'
]);

Route::get('/home', [
    'uses' => 'HomeController@pageLoad',
    'as' => 'HomeController_pageLoad'
]);

Route::get('/Destination/{id}', [
    'uses' => 'DestinationController@pageLoad',
    'as' => 'DestinationController_pageLoad'
]);

Route::get('/HotelOrRestaurant/{id}', [
    'uses' => 'HotelController@pageLoad',
    'as' => 'HotelController_pageLoad'
]);


Route::get('/SimpleUser/{id?}', [
    'uses' => 'SimpleUserController@pageLoad',
    'as' => 'SimpleUserController_pageLoad'
]);


Route::get('/BusinessUser/{id?}', [
    'uses' => 'BusinessUserController@pageLoad',
    'as' => 'BusinessUserController_pageLoad'
]);

Route::get('/SignUp', [
    'uses' => 'SignUpController@pageLoad',
    'as' => 'SignUpController_pageLoad'
]);


Route::get('/Login', [
    'uses' => 'LoginController@pageLoad',
    'as' => 'LoginController_pageLoad'
]);

Route::get('/SearchResults', [
    'uses' => 'SearchResultsController@pageLoad',
    'as' => 'SearchResultsController_pageLoad'
]);

Route::get('/logout', [
    'uses' => 'LogoutController@logout',
    'as' => 'logout'
]);


Route::get('/privacyPolicy', function(){
    return view('privacypolicy');
});

Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {

});


Route::get('/redirect', 'SocialAuthFacebookController@redirect')->name( 'facebookLogin' );
Route::get('/callback', 'SocialAuthFacebookController@callback')->name('facebookCallBack');


Route::group( ['middleware' => ['web']] , function(){

    Route::post('/processSearchString',[
        'uses' => 'HomeController@processSearchString',
        'as' => 'HomeController_processSearchString'
    ]);






    Route::post('/SignUpSubmit',[
        'uses' => 'SignUpController@SignUpSubmit',
        'as' => 'SignUpController_SignUpSubmit'
    ]);


    Route::post('/LoginSubmit',[
        'uses' => 'LoginController@loginSubmit',
        'as' => 'LoginController_loginSubmit'
    ]);








    Route::post('/addNewHotel',[
        'uses' => 'BusinessUserController@addNewHotel',
        'as' => 'BusinessUserController_addNewHotel'
    ]);


    Route::post('/addNewRestaurant',[
        'uses' => 'BusinessUserController@addNewRestaurant',
        'as' => 'BusinessUserController_addNewRestaurant'
    ]);

    Route::post('/addNewTravelOption',[
        'uses' => 'BusinessUserController@addNewTravelOption',
        'as' => 'BusinessUserController_addNewTravelOption'
    ]);


    Route::post('/changeProfilePic',[
        'uses' => 'BusinessUserController@changeProfilePic',
        'as' => 'BusinessUserController_changeProfilePic'
    ]);







    Route::post('/addNewHotelSimpleUser',[
        'uses' => 'SimpleUserController@addNewHotel',
        'as' => 'SimpleUserController_addNewHotel'
    ]);


    Route::post('/addNewRestaurantSimpleUser',[
        'uses' => 'SimpleUserController@addNewRestaurant',
        'as' => 'SimpleUserController_addNewRestaurant'
    ]);


    Route::post('/changeProfilePicSimpleUser',[
        'uses' => 'SimpleUserController@changeProfilePic',
        'as' => 'SimpleUserController_changeProfilePic'
    ]);


    Route::post('/rateHotel',[
        'uses' => 'HotelController@rate',
        'as' => 'HotelController_rate'
    ]);
});



/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/