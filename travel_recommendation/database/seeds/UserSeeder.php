<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $newUser = new User();

        $newUser->username = "Username";
        $newUser->password = password_hash( "password" , PASSWORD_DEFAULT ) ;
        $newUser->email = "DummyEmail@yahoo.com";
        $newUser->dob = "2018/4/18";
        $newUser->name = "Abdullah Siddiqui";
        $newUser->gender = "Male";
        $newUser->type = "Business";
        $newUser->image = "user_images/dummyMaleImage.png";

        $newUser->save();



        $newUser = new User();

        $newUser->username = "Username1";
        $newUser->password = password_hash( "password" , PASSWORD_DEFAULT ) ;
        $newUser->email = "DummyEmail1@yahoo.com";
        $newUser->dob = "2018/4/18";
        $newUser->name = "Abdullah Siddiqui";
        $newUser->gender = "Male";
        $newUser->type = "Simple";
        $newUser->image = "user_images/dummyMaleImage.png";

        $newUser->save();

    }
}
